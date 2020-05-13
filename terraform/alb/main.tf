provider "aws" {
  region  = "ap-northeast-1"
  version = "2.8"
}

terraform {
  required_version = "0.12.24"
  backend "s3" {
    bucket = "kousatu-private"
    key    = "terraform/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
