output "security_group_id" {
  value = aws_security_group.kousatu.id
}

output "public-a-id" {
  value = aws_subnet.public-a.id
}

output "public-c-id" {
  value = aws_subnet.public-c.id
}

output "private-a-id" {
  value = aws_subnet.private-a.id
}

output "private-c-id" {
  value = aws_subnet.private-c.id
}

output "kousatu_id" {
  value = aws_vpc.kousatu.id
}

output "cidr_block" {
  value = aws_vpc.kousatu.cidr_block
}

