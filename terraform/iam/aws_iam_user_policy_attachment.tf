resource "aws_iam_user_policy_attachment" "ecr" {
  user       = aws_iam_user.kousatu.name
  policy_arn = data.aws_iam_policy.ecr.arn
}

resource "aws_iam_user_policy_attachment" "s3" {
  user       = aws_iam_user.kousatu.name
  policy_arn = data.aws_iam_policy.s3.arn
}