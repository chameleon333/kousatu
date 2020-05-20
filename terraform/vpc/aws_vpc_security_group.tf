resource "aws_security_group" "kousatu" {
  name        = "EC2ContainerService-kousatu-cluster-EcsSecurityGroup-Q6QP84LCOFA1"
  vpc_id      = aws_vpc.kousatu.id
  description = "ECS Allowed Ports"
}

# #80ポートを許可
resource "aws_security_group_rule" "kousatu" {
  type              = "ingress"
  from_port         = 80
  to_port           = 80
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.kousatu.id
}

# #全ポートを許可
resource "aws_security_group_rule" "kousatu-1" {
  type                     = "ingress"
  from_port                = 0
  to_port                  = 65535
  protocol                 = "tcp"
  source_security_group_id = "sg-0143775b724cc6164"
  security_group_id        = aws_security_group.kousatu.id
}

# #22ポートを許可
resource "aws_security_group_rule" "kousatu-2" {
  type              = "ingress"
  from_port         = 22
  to_port           = 22
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.kousatu.id
}

#全てのポートを許可
resource "aws_security_group_rule" "kousatu-3" {
  type              = "egress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.kousatu.id
}

output "security_group_id" {
  value = aws_security_group.kousatu.id
}

