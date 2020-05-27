resource "aws_s3_bucket_policy" "artifact" {
  bucket = aws_s3_bucket.private.id
  policy = data.aws_iam_policy_document.artifact.json
}

data "aws_iam_policy_document" "artifact" {
  statement {
    effect    = "Allow"
    actions   = ["s3:PutObject"]
    resources = ["arn:aws:s3:::${aws_s3_bucket.private.id}/*"]

    #identifiersでIDを指定します
    principals {
      type        = "AWS"
      identifiers = ["arn:aws:iam::582318560864:root"]
    }
  }

  statement {
    effect    = "Allow"
    actions   = ["s3:PutObject"]
    resources = ["arn:aws:s3:::${aws_s3_bucket.private.id}/*"]
    principals {
      type        = "Service"
      identifiers = ["delivery.logs.amazonaws.com"]
    }

    condition {
      test     = "StringEquals"
      variable = "s3:x-amz-acl"
      values   = ["bucket-owner-full-control"]
    }
  }

  statement {
    effect    = "Allow"
    actions   = ["s3:GetBucketAcl"]
    resources = ["arn:aws:s3:::${aws_s3_bucket.private.id}"]
    principals {
      type        = "Service"
      identifiers = ["delivery.logs.amazonaws.com"]
    }
  }
}
