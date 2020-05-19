terraform {
  required_version = "0.12.24"
  backend "s3" {
    bucket = "kousatu-private"
    key    = "terraform/alb/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
