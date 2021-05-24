#インターネットゲートウェイ
resource "aws_internet_gateway" "kousatu" {
  vpc_id = aws_vpc.kousatu.id
}

resource "aws_egress_only_internet_gateway" "egress" {
  vpc_id = aws_vpc.kousatu.id
}

#ルートテーブル
resource "aws_route_table" "kousatu" {
  vpc_id = aws_vpc.kousatu.id
}

resource "aws_route" "local" {
  gateway_id = aws_internet_gateway.kousatu.id
  #   destination_cidr_block = "10.0.0.0/16"
  destination_cidr_block = "0.0.0.0/0"
  route_table_id         = aws_route_table.kousatu.id
  depends_on             = [aws_route_table.kousatu]
}

resource "aws_route" "kousatu" {
  gateway_id             = aws_internet_gateway.kousatu.id
  destination_cidr_block = "0.0.0.0/0"
  route_table_id         = aws_route_table.kousatu.id
  depends_on             = [aws_route_table.kousatu]
}
