variable "staging_docker_image" {
  type = string
}

data "template_file" "staging_appversion" {
  template = "${file("application_version.json.tpl")}"
  vars = {
    image_tag = var.staging_docker_image
  }
}

resource "aws_s3_bucket_object" "staging_appversion" {
  bucket = "hack-docs-terraform-state"
  key = "hack-docs/staging-${terraform.workspace}-versions/${var.staging_docker_image}.json"
  content = data.template_file.staging_appversion.rendered
}

resource "aws_elastic_beanstalk_application_version" "docs_staging" {
  application = aws_elastic_beanstalk_application.docs.name
  name = "tf-staging-${terraform.workspace}-${var.staging_docker_image}"
  bucket = aws_s3_bucket_object.staging_appversion.bucket
  key = aws_s3_bucket_object.staging_appversion.id
}

resource "aws_elastic_beanstalk_environment" "docs_staging" {
  application = aws_elastic_beanstalk_application.docs.name
  name = "hhvm-hack-docs-vpc-staging-${terraform.workspace}"
  cname_prefix = "hack-hhvm-docs-vpc-staging-${terraform.workspace}"
  template_name = aws_elastic_beanstalk_configuration_template.docs.name
  version_label = aws_elastic_beanstalk_application_version.docs_staging.id
  tags = {
    DockerImage = var.staging_docker_image
  }
}
