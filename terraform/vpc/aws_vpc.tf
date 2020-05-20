resource "aws_vpc" "kousatu" {

  cidr_block = "10.0.0.0/16"

  #AWSのDNSサーバーによる名前解決を有効にする
  #route53の有効化
  enable_dns_support   = true
  enable_dns_hostnames = true

  tags = {
    "Name" = "kousatu-ecs-vpc"
  }
}