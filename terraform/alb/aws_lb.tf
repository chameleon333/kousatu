resource "aws_lb" "kousatu" {
  idle_timeout       = 60
  internal           = false
  load_balancer_type = "application"
  name               = "kousatu-load-balancer"

  security_groups = [
    aws_security_group.kousatu.id
  ]

  subnets = [
    data.terraform_remote_state.vpc.outputs.public-a-id,
    data.terraform_remote_state.vpc.outputs.public-c-id,
  ]

  access_logs {
    bucket  = data.terraform_remote_state.s3.outputs.artifact_id
    enabled = true
    prefix  = "terraform"
  }

}

output "alb_dns_name" {
  value = aws_lb.kousatu.dns_name
}

data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "kousatu-private"
    key    = "terraform/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}

data "terraform_remote_state" "s3" {
  backend = "s3"
  config = {
    bucket = "kousatu-private"
    key    = "terraform/s3/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
