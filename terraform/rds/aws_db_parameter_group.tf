resource "aws_db_parameter_group" "kousatu" {
  description = "Default parameter group for mysql5.7"
  family = "mysql5.7"
  tags   = {}
}
