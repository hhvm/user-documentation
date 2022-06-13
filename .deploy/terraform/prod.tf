variable "prod_docker_image" {
  type = string
}

data "template_file" "prod_appversion" {
  template = "${file("application_version.json.tpl")}"
  vars = {
    image_tag = var.prod_docker_image
  }
}

resource "aws_s3_bucket_object" "prod_appversion" {
  bucket = "hack-docs-terraform-state"
  key = "hack-docs/prod-${terraform.workspace}-versions/${var.prod_docker_image}.json"
  content = data.template_file.prod_appversion.rendered
}

resource "aws_elastic_beanstalk_application_version" "docs_prod" {
  application = aws_elastic_beanstalk_application.docs.name
  name = "tf-prod-${terraform.workspace}-${var.prod_docker_image}"
  bucket = aws_s3_bucket_object.prod_appversion.bucket
  key = aws_s3_bucket_object.prod_appversion.id
}

resource "aws_elastic_beanstalk_environment" "docs_prod" {
  application = aws_elastic_beanstalk_application.docs.name
  name = "hhvm-hack-docs-vpc-prod-${terraform.workspace}"
  cname_prefix = "hack-hhvm-docs-vpc-prod-${terraform.workspace}"
  template_name = aws_elastic_beanstalk_configuration_template.docs.name
  version_label = aws_elastic_beanstalk_application_version.docs_prod.id
  tags = {
    DockerImage = var.prod_docker_image
  }
}
