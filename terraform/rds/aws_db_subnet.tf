resource "aws_db_subnet_group" "kousatu" {
  description = "Created from the RDS Management Console"
  subnet_ids = [
    data.terraform_remote_state.vpc.outputs.public-a-id,
    data.terraform_remote_state.vpc.outputs.public-c-id,
    data.terraform_remote_state.vpc.outputs.private-a-id,
    data.terraform_remote_state.vpc.outputs.private-c-id,
  ]
}
