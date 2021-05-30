data "template_file" "task-role-template" {
  template = file("./task_role.json")
}

data "template_file" "ec2-role-template" {
  template = file("./ec2_role.json")
}

resource "aws_iam_role" "task-role" {
  name               = "ecsTaskExecutionRole"
  assume_role_policy = data.template_file.task-role-template.rendered
}

resource "aws_iam_role" "ec2-role" {
  name               = "eC2ContainerServiceEC2Role"
  assume_role_policy = data.template_file.ec2-role-template.rendered
}

resource "aws_iam_role_policy_attachment" "ec2-role" {
  role       = aws_iam_role.ec2-role.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AmazonEC2ContainerServiceforEC2Role"
}

# ecs task
resource "aws_iam_role_policy_attachment" "task_role" {
  policy_arn = "arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy"
  role       = aws_iam_role.task-role.name
}
