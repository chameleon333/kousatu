resource "aws_security_group" "vpc-kousatu" {
  name        = "EC2ContainerService-kousatu-cluster-EcsSecurityGroup-Q6QP84LCOFA1"
  vpc_id      = aws_vpc.kousatu.id
  description = "ECS Allowed Ports"
}

# #80ポートを許可
resource "aws_security_group_rule" "vpc-kousatu" {
  type              = "ingress"
  from_port         = 80
  to_port           = 80
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.vpc-kousatu.id
}

# #全ポートを許可
resource "aws_security_group_rule" "vpc-kousatu-1" {
  type              = "ingress"
  from_port         = 0
  to_port           = 65535
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.vpc-kousatu.id
}

# #22ポートを許可
resource "aws_security_group_rule" "vpc-kousatu-2" {
  type              = "ingress"
  from_port         = 22
  to_port           = 22
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.vpc-kousatu.id
}

#全てのポートを許可
resource "aws_security_group_rule" "vpc-kousatu-3" {
  type              = "egress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.vpc-kousatu.id
}
