variable "staging_docker_image" {
  type = string
}

data "template_file" "staging_appversion" {
  template = "${file("application_version.json.tpl")}"
  vars = {
    image_tag = var.staging_docker_image
  }
}
