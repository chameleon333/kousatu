resource "aws_security_group" "kousatu" {
  name        = "ecs-lb-sg"
  vpc_id      = data.terraform_remote_state.vpc.outputs.kousatu_id
  description = "load-balancer-wizard-1 created on 2020-03-03T21:19:06.401+09:00"
}

# #80ポートを許可
resource "aws_security_group_rule" "inbound_http" {
  type              = "ingress"
  from_port         = 80
  to_port           = 80
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.kousatu.id
}

# #443ポートを許可
resource "aws_security_group_rule" "inbound_https" {
  type              = "ingress"
  from_port         = 443
  to_port           = 443
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.kousatu.id
}

#全てのポートを許可
resource "aws_security_group_rule" "outbound" {
  type              = "egress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.kousatu.id
}
