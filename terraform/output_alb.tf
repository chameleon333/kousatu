output "alb_security_group_id" {
  value = aws_security_group.db-kousatu.id
}

output "domain_name" {
  value = aws_route53_record.kousatu.name
}

output "alb_dns_name" {
  value = aws_lb.kousatu.dns_name
}

output "lb_target_group_arn" {
  value = aws_lb_target_group.kousatu.arn
}
