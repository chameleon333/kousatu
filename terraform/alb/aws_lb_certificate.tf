#HTTPS化するために必要な設定
#SSL証明を発行
resource "aws_acm_certificate" "kousatu" {
  domain_name               = aws_route53_record.kousatu.name
  subject_alternative_names = []

  # ドメインの所有権の検証方法
  validation_method = "DNS"

  lifecycle {
    # 新しいSSL証明書を作成してから、古いSSLと差し替える
    create_before_destroy = true
  }
}

#DNS用のSSL
resource "aws_route53_record" "kousatu_certificate" {
  name    = aws_acm_certificate.kousatu.domain_validation_options[0].resource_record_name
  type    = aws_acm_certificate.kousatu.domain_validation_options[0].resource_record_type
  records = [aws_acm_certificate.kousatu.domain_validation_options[0].resource_record_value]
  zone_id = data.aws_route53_zone.kousatu.zone_id
  ttl     = 300
}

#apply時SSL証明書の検証が完了するまで待つ
resource "aws_acm_certificate_validation" "kousatu" {
  certificate_arn         = aws_acm_certificate.kousatu.arn
  validation_record_fqdns = [aws_route53_record.kousatu_certificate.fqdn]
}
