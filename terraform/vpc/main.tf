provider "aws" {
  region = "ap-northeast-1"
}

terraform {
  backend "s3" {
    bucket = "kousatu-private"
    key    = "terraform/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}