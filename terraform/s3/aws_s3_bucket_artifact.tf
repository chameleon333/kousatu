resource "aws_s3_bucket" "artifact" {
  bucket = "kousatu-private"

  lifecycle_rule {
    enabled = true

    expiration {
      days = "180"
    }
  }
}