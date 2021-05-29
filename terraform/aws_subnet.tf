#サブネット
resource "aws_subnet" "public-a" {
  vpc_id                          = aws_vpc.kousatu.id
  assign_ipv6_address_on_creation = false
  availability_zone               = "ap-northeast-1a"
  cidr_block                      = "10.0.0.0/24"
  map_public_ip_on_launch         = true
  tags = {
    "Name" = "public-a"
  }
  timeouts {}
}

resource "aws_subnet" "public-c" {
  vpc_id                          = aws_vpc.kousatu.id
  assign_ipv6_address_on_creation = false
  availability_zone               = "ap-northeast-1c"
  cidr_block                      = "10.0.2.0/24"
  map_public_ip_on_launch         = true
  tags = {
    "Name" = "public-c"
  }
  timeouts {}
}

resource "aws_subnet" "private-a" {
  vpc_id                          = aws_vpc.kousatu.id
  assign_ipv6_address_on_creation = false
  availability_zone               = "ap-northeast-1a"
  cidr_block                      = "10.0.1.0/24"
  map_public_ip_on_launch         = false
  tags = {
    "Name" = "private-a"
  }
  timeouts {}
}

resource "aws_subnet" "private-c" {
  vpc_id                          = aws_vpc.kousatu.id
  assign_ipv6_address_on_creation = false
  availability_zone               = "ap-northeast-1c"
  cidr_block                      = "10.0.3.0/24"
  map_public_ip_on_launch         = false
  tags = {
    "Name" = "private-c"
  }
  timeouts {}
}
