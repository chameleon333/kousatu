resource "aws_db_subnet_group" "kousatu" {
  description = "Created from the RDS Management Console"
  subnet_ids = [
    aws_subnet.public-a.id,
    aws_subnet.public-c.id,
    aws_subnet.private-a.id,
    aws_subnet.private-c.id,
  ]
}
