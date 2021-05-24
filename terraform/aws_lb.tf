resource "aws_lb" "kousatu" {
  idle_timeout       = 60
  internal           = false
  load_balancer_type = "application"
  name               = "kousatu-load-balancer"

  security_groups = [
    aws_security_group.kousatu.id
  ]

  subnets = [
    aws_subnet.public-a.id,
    aws_subnet.public-c.id,
  ]

  access_logs {
    bucket  = aws_s3_bucket.private.id
    enabled = true
    prefix  = "lb"
  }

}
