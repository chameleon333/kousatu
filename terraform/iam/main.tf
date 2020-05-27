provider "aws" {
  region = "ap-northeast-1"
}

terraform {
  backend "s3" {
    bucket = "kousatu-private"
    key    = "terraform/iam/terraform.tfstate"
    region = "ap-northeast-1"
  }
}