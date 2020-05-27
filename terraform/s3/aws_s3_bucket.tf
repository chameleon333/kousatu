# #外部公開しないプライベートバケット
resource "aws_s3_bucket" "private" {

  lifecycle_rule {
    enabled                                = true
    abort_incomplete_multipart_upload_days = 0
    tags                                   = {}
    expiration {
      days                         = "180"
      expired_object_delete_marker = false
    }
  }
  bucket = "kousatu-private"
  versioning {
    enabled = true
  }
}

#公開用
resource "aws_s3_bucket" "public" {
  # acl = "public"
  server_side_encryption_configuration {
    rule {
      apply_server_side_encryption_by_default {
        sse_algorithm = "AES256"
      }
    }
  }
}

