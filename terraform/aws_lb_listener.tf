
#HTTPSでALBにアクセスできるようHTTPSリスナーを発行
resource "aws_lb_listener" "https" {
  load_balancer_arn = aws_lb.kousatu.arn
  port              = "443"
  protocol          = "HTTPS"

  #発行した証明書
  certificate_arn = aws_acm_certificate.kousatu.arn
  ssl_policy      = "ELBSecurityPolicy-2016-08"

  default_action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.kousatu.arn
  }
}

#リダイレクト
resource "aws_lb_listener" "http" {
  load_balancer_arn = aws_lb.kousatu.arn
  port              = "80"
  protocol          = "HTTP"

  default_action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.kousatu.arn
  }
}

