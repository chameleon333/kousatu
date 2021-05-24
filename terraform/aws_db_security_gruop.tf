resource "aws_security_group" "db-kousatu" {
  name        = "ecs-db-sg"
  vpc_id      = aws_vpc.kousatu.id
  description = "DB VPC security group"
}

# #全ポートを許可
resource "aws_security_group_rule" "db-kousatu" {
  type              = "ingress"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  cidr_blocks       = []
  self              = true
  security_group_id = aws_security_group.db-kousatu.id
}

# 3306ポートを許可
resource "aws_security_group_rule" "db-kousatu-1" {
  type              = "ingress"
  from_port         = 3306
  to_port           = 3306
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.db-kousatu.id
}

#全てのポートを許可
resource "aws_security_group_rule" "db-kousatu-2" {
  type              = "egress"
  ipv6_cidr_blocks  = []
  prefix_list_ids   = []
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.db-kousatu.id
}

