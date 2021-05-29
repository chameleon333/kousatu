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

resource "aws_route" "kousatu" {
  route_table_id         = aws_route_table.kousatu.id
  gateway_id             = aws_internet_gateway.kousatu.id
  destination_cidr_block = "0.0.0.0/0"
  depends_on             = [aws_route_table.kousatu]
}

resource "aws_main_route_table_association" "a" {
  vpc_id         = aws_vpc.kousatu.id
  route_table_id = aws_route_table.kousatu.id
}
