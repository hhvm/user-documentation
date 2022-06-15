##### WARNING #####
# The ElasticBeanstalk IPAddressType and SecurityGroup settings for load
# balancers are currently silently ignored by AWS.
#
# If you are using this to set up a new instance, you'll need to:
# - change the s3 bucket used for state to one you control
# - manually change the load balancers to dual stack and set the security group
#
# Otherwise connections from the internet will be dropped.
terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 3.0"
    }
  }
  backend "s3" {
    region = "us-west-2"
    bucket = "hack-docs-terraform-state"
    key = "hack-docs/tfstate"
    dynamodb_table = "hack-docs-tfstate"
  }
}

provider "aws" {
  region = "us-west-2"
  default_tags {
    tags = {
      Creator = "Terraform"
    }
  }
}
