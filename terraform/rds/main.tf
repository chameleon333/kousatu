provider "aws" {
  region = "ap-northeast-1"
}

terraform {
  backend "s3" {
    bucket = "kousatu-private"
    key    = "terraform/rds/terraform.tfstate"
    region = "ap-northeast-1"
  }
}

data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "kousatu-private"
    key    = "terraform/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}