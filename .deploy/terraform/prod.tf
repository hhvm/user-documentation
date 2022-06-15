variable "prod_docker_image" {
  type = string
}

data "template_file" "prod_appversion" {
  template = "${file("application_version.json.tpl")}"
  vars = {
    image_tag = var.prod_docker_image
  }
}
