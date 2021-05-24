resource "aws_ecr_repository" "php" {
  name = "kousatu_php"
}

resource "aws_ecr_repository" "nginx" {
  name = "kousatu_nginx"
}
