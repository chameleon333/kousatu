data "aws_route53_zone" "kousatu" {
  name = "the-kousatu.com"
}

#DNSレコード
resource "aws_route53_record" "kousatu" {
  zone_id = data.aws_route53_zone.kousatu.zone_id
  name    = data.aws_route53_zone.kousatu.name

  #DNSレコードタイプ
  type = "A"

  alias {
    evaluate_target_health = false
    name                   = aws_lb.kousatu.dns_name
    zone_id                = aws_lb.kousatu.zone_id
  }
}
