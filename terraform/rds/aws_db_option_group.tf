resource "aws_db_option_group" "kousatu" {
  option_group_description = "Default option group for mysql 5.7"
  engine_name              = "mysql"
  major_engine_version     = "5.7"
}
