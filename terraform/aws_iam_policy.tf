data "aws_iam_policy" "ecr" {
  arn = "arn:aws:iam::aws:policy/AmazonEC2ContainerRegistryFullAccess"
}

data "aws_iam_policy" "s3" {
  arn = "arn:aws:iam::aws:policy/AmazonS3FullAccess"
}