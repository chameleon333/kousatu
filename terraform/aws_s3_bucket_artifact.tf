resource "aws_s3_bucket" "artifact" {
  bucket = "kousatu-private-artifact"

  lifecycle_rule {
    enabled = true

    expiration {
      days = "180"
    }
  }
}
