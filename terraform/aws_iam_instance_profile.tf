# EC2がECSを利用できるように
resource "aws_iam_instance_profile" "kousatu" {
  name = "es2_container_service"
  role = aws_iam_role.ec2-role.name
}
