#インターネットゲートウェイ
resource "aws_internet_gateway" "kousatu" {
  vpc_id = aws_vpc.kousatu.id
}

#ルートテーブル
resource "aws_route_table" "kousatu" {
  vpc_id = aws_vpc.kousatu.id
}

resource "aws_route" "local" {
  destination_cidr_block = "10.0.0.0/16"
  route_table_id         = aws_route_table.kousatu.id
}

resource "aws_route" "kousatu" {
  destination_cidr_block = "0.0.0.0/0"
  route_table_id         = aws_route_table.kousatu.id
}