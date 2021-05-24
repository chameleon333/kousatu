provider "aws" {
  version                 = "~> 2.0"
  region                  = var.region
  profile                 = var.profile
  shared_credentials_file = var.shared_credentials_file
}

provider "template" {
  version = "~> 2.1"
}
