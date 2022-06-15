terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 4.17.0"
    }
  }
  backend "s3" {
    region         = "us-west-2"
    bucket         = "hack-docs-terraform-state"
    key            = "hack-docs/tfstate"
    dynamodb_table = "hack-docs-tfstate"
  }
}

module "networking" {
  source                                      = "cn-terraform/networking/aws"
  name_prefix                                 = "docs-${terraform.workspace}"
  vpc_cidr_block                              = "192.168.0.0/16"
  availability_zones                          = ["us-west-2a", "us-west-2b", "us-west-2c", "us-west-2d"]
  public_subnets_cidrs_per_availability_zone  = ["192.168.0.0/19", "192.168.32.0/19", "192.168.64.0/19", "192.168.96.0/19"]
  private_subnets_cidrs_per_availability_zone = ["192.168.128.0/19", "192.168.160.0/19", "192.168.192.0/19", "192.168.224.0/19"]
  single_nat                                  = true
}

module "ecs-fargate" {
  source  = "cn-terraform/ecs-fargate/aws"
  version = "2.0.41"

  name_prefix                  = "docs-${terraform.workspace}"
  vpc_id                       = module.networking.vpc_id
  public_subnets_ids           = module.networking.public_subnets_ids
  private_subnets_ids          = module.networking.private_subnets_ids
  container_name               = "docs-${terraform.workspace}"
  container_image              = var.container_image
  container_cpu                = 4096
  container_memory             = 8192
  container_memory_reservation = 4096

  enable_s3_logs = false

  default_certificate_arn = "arn:aws:acm:us-west-2:223121549624:certificate/8f845b56-937f-49b8-adf4-64b69a3caf57"

  lb_https_ports = {
    forward_https_to_http = {
      listener_port     = 443
      target_group_port = 80
    }
  }

  log_configuration = {
    logDriver = "awslogs"
    options = {
      "awslogs-region"        = "us-west-2"
      "awslogs-group"         = "/ecs/service/docs-${terraform.workspace}"
      "awslogs-stream-prefix" = "ecs"
    }
    secretOptions = null
  }
}
