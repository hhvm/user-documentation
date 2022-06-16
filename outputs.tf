output "aws_lb_lb_dns_name" {
  description = "The DNS name of the load balancer."
  value       = module.ecs-fargate.aws_lb_lb_dns_name
}
