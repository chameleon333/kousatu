resource "aws_ecs_cluster" "kousatu" {
  name = "kousatu-cluster"
}

resource "aws_ecs_service" "kousatu" {
  name                              = "ecs-kousatu-service"
  cluster                           = aws_ecs_cluster.kousatu.id
  task_definition                   = aws_ecs_task_definition.kousatu.arn
  desired_count                     = 1
  launch_type                       = "EC2"
  health_check_grace_period_seconds = 0

  load_balancer {
    target_group_arn = data.terraform_remote_state.alb.outputs.lb_target_group_arn
    container_name   = "nginx"
    container_port   = "80"
  }

  ordered_placement_strategy {
    field = "attribute:ecs.availability-zone"
    type  = "spread"
  }
  ordered_placement_strategy {
    field = "instanceId"
    type  = "spread"
  }

}

data "template_file" "service_container_definition" {
  template = file("./task-definitions/service.json")
}

resource "aws_ecs_task_definition" "kousatu" {
  family                = "kousatu-task"
  container_definitions = data.template_file.service_container_definition.rendered
  task_role_arn         = data.terraform_remote_state.iam.outputs.ecs_role_arn
  execution_role_arn    = data.terraform_remote_state.iam.outputs.ecs_role_arn
  network_mode          = "bridge"
  cpu                   = "1024"
  memory                = "800"
  requires_compatibilities = [
    "EC2",
  ]

  volume {
    name = "src"
  }
}


data "terraform_remote_state" "iam" {
  backend = "s3"
  config = {
    bucket = "kousatu-private"
    key    = "terraform/iam/terraform.tfstate"
    region = "ap-northeast-1"
  }
}

data "terraform_remote_state" "alb" {
  backend = "s3"
  config = {
    bucket = "kousatu-private"
    key    = "terraform/alb/terraform.tfstate"
    region = "ap-northeast-1"
  }
}