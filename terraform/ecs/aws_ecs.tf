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


resource "aws_launch_configuration" "kousatu" {
  image_id = "ami-00c408a8b71d5c614"
  instance_type               = "t2.micro"
  user_data = file("./user_data.sh")
  iam_instance_profile        = data.terraform_remote_state.iam.outputs.aws_iam_instance_profile_arn
  security_groups             = [data.terraform_remote_state.vpc.outputs.security_group_id]
  associate_public_ip_address = true

}

resource "aws_autoscaling_group" "kousatu" {
  max_size                  = 2
  min_size                  = 0
  health_check_grace_period = 0
  health_check_type         = "EC2"
  launch_configuration = aws_launch_configuration.kousatu.id
  # tag {
  #     key                 = "Description"
  #     propagate_at_launch = true
  #     value               = "This instance is the part of the Auto Scaling group which was created through ECS Console"
  #   }
  # tag {
  #     key                 = "Name"
  #     propagate_at_launch = true
  #     value               = "ECS Instance - EC2ContainerService-kousatu-cluster"
  #   }
  # tag {
  #     key                 = "aws:cloudformation:logical-id"
  #     propagate_at_launch = true
  #     value               = "EcsInstanceAsg"
  #   }
  # tag {
  #     key                 = "aws:cloudformation:stack-id"
  #     propagate_at_launch = true
  #     value               = "arn:aws:cloudformation:ap-northeast-1:636153449311:stack/EC2ContainerService-kousatu-cluster/c1263090-5d4a-11ea-8894-0693e5f01c30"
  #   }
  # tag {
  #     key                 = "aws:cloudformation:stack-name"
  #     propagate_at_launch = true
  #     value               = "EC2ContainerService-kousatu-cluster"
  #   }
}

resource "aws_appautoscaling_target" "kousatu" {
  min_capacity       = 1
  max_capacity       = 2
  resource_id        = "service/kousatu-cluster/ecs-kousatu-service"
  scalable_dimension = "ecs:service:DesiredCount"
  service_namespace  = "ecs"
}


resource "aws_appautoscaling_policy" "kousatu" {
  name = "tracking"
  service_namespace = aws_appautoscaling_target.kousatu.service_namespace
  scalable_dimension = aws_appautoscaling_target.kousatu.scalable_dimension
  resource_id = aws_appautoscaling_target.kousatu.resource_id
  policy_type = "TargetTrackingScaling"

  target_tracking_scaling_policy_configuration {
    disable_scale_in   = false
    scale_in_cooldown  = 300
    scale_out_cooldown = 300
    target_value       = 75

    predefined_metric_specification {
        predefined_metric_type = "ECSServiceAverageCPUUtilization"
      }
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

data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "kousatu-private"
    key    = "terraform/vpc/terraform.tfstate"
    region = "ap-northeast-1"
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