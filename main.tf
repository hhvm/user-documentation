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

