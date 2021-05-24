output "ecs_role_arn" {
  value = aws_iam_role.task-role.arn
}

output "aws_iam_instance_profile_arn" {
  value = aws_iam_instance_profile.kousatu.arn
}
