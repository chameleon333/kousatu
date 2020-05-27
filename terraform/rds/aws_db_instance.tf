resource "aws_db_instance" "kousatu" {
  identifier             = "kousatu"
  engine                 = "mysql"
  engine_version         = "5.7.28"
  instance_class         = "db.t2.micro"
  skip_final_snapshot    = true
  max_allocated_storage  = 1000
  storage_type           = "gp2"
  copy_tags_to_snapshot  = true
  port                   = 3306
  vpc_security_group_ids = [aws_security_group.kousatu.id]
  parameter_group_name   = aws_db_parameter_group.kousatu.name
  option_group_name      = aws_db_option_group.kousatu.name
  db_subnet_group_name   = aws_db_subnet_group.kousatu.name
}