resource "aws_lb_target_group" "kousatu" {
  name = "ecs-lb-default-tg"

  #ターゲットの種類
  vpc_id   = aws_vpc.kousatu.id
  port     = 80
  protocol = "HTTP"

  deregistration_delay = 300

  health_check {
    port                = "traffic-port"
    interval            = 30
    path                = "/"
    protocol            = "HTTP"
    unhealthy_threshold = 2
    healthy_threshold   = 5
    timeout             = 10
    matcher             = "200,301,302"
  }

  depends_on = [aws_lb.kousatu]
}

# ターゲットグループにリクエストを飛ばすリスナールールを作成
resource "aws_lb_listener_rule" "kousatu" {
  listener_arn = aws_lb_listener.http.arn
  priority     = 1
  action {
    order            = 1
    type             = "redirect"
    target_group_arn = aws_lb_target_group.kousatu.arn

    redirect {
      port        = "443"
      protocol    = "HTTPS"
      status_code = "HTTP_301"
    }

  }

  condition {
    path_pattern {
      values = ["*"]
    }
  }

}

