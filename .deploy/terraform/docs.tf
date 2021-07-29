terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 3.0"
    }
  }
}

provider "aws" {
  region = "us-west-2"
  default_tags {
    tags = {
      Creator = "Terraform"
    }
  }
}

resource "aws_vpc" "main" {
  cidr_block = "10.0.0.0/16"
  tags = {
    Name = "Hack/HHVM docs"
  }
  assign_generated_ipv6_cidr_block = true
}

resource "aws_subnet" "az_a" {
  vpc_id = aws_vpc.main.id
  cidr_block = "10.0.0.0/24"
  availability_zone = "us-west-2c"
  tags = {
    Name = "Hack/HHVM docs AZ a"
  }
  map_public_ip_on_launch = true
  ipv6_cidr_block = cidrsubnet(aws_vpc.main.ipv6_cidr_block, 8, 1)
  assign_ipv6_address_on_creation = true
}

resource "aws_subnet" "az_b" {
  vpc_id = aws_vpc.main.id
  cidr_block = "10.0.1.0/24"
  availability_zone = "us-west-2a"
  tags = {
    Name = "Hack/HHVM docs AZ b"
  }
  map_public_ip_on_launch = true
  ipv6_cidr_block = cidrsubnet(aws_vpc.main.ipv6_cidr_block, 8, 2)
  assign_ipv6_address_on_creation = true
}

resource "aws_security_group" "bastion" {
  name = "Hack/HHVM docs bastion"
  vpc_id = aws_vpc.main.id
  ingress {
    description = "SSH"
    from_port = 22
    to_port = 22
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
    ipv6_cidr_blocks = [ "::/0" ]
  }
  egress {
    from_port = 0
    to_port = 0
    protocol = "-1"
    cidr_blocks = [ "0.0.0.0/0" ]
    ipv6_cidr_blocks = [ "::/0" ]
  }
  tags = {
    Name = "Hack/HHVM docs bastion"
  }
}

resource "aws_security_group" "internal" {
  name = "Hack/HHVM docs internal"
  vpc_id = aws_vpc.main.id
  ingress {
    description = "SSH"
    from_port = 22
    to_port = 22
    protocol = "tcp"
    cidr_blocks = [aws_vpc.main.cidr_block]
  }
  ingress {
    description = "HTTP"
    from_port = 80
    to_port = 80
    protocol = "tcp"
    cidr_blocks = [aws_vpc.main.cidr_block]
  }
  egress {
    from_port = 0
    to_port = 0
    protocol = "-1"
    cidr_blocks = [ "0.0.0.0/0" ]
    ipv6_cidr_blocks = [ "::/0" ]
  }
  tags = {
    Name = "Hack/HHVM docs internal"
  }
}

resource "aws_security_group" "public" {
  name = "Hack/HHVM docs public"
  vpc_id = aws_vpc.main.id
  ingress {
    description = "HTTP"
    from_port = 80
    to_port = 80
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
    ipv6_cidr_blocks = ["::/0"]
  }
  ingress {
    description = "HTTPS"
    from_port = 443
    to_port = 443
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
    ipv6_cidr_blocks = ["::/0"]
  }
  egress {
    from_port = 0
    to_port = 0
    protocol = "-1"
    cidr_blocks = [ "0.0.0.0/0" ]
    ipv6_cidr_blocks = ["::/0"]
  }
  tags = {
    Name = "Hack/HHVM docs LB"
  }
}

resource "aws_internet_gateway" "main" {
  vpc_id = aws_vpc.main.id
  tags = {
    Name = "Hack/HHVM docs IGW"
  }
}

resource "aws_route_table" "main" {
  vpc_id = aws_vpc.main.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.main.id
  }
}

resource "aws_elastic_beanstalk_application" "docs" {
  name = "hhvm-hack-docs"
  appversion_lifecycle {
    delete_source_from_s3 = true
    max_age_in_days       = 0
    max_count             = 200
    service_role          = "arn:aws:iam::223121549624:role/aws-elasticbeanstalk-service-role"
  }
}

resource "aws_elastic_beanstalk_configuration_template" "docs" {
  name = "hhvm-hack-docs-vpc"
  application = aws_elastic_beanstalk_application.docs.name
  solution_stack_name = "64bit Amazon Linux 2 v3.4.3 running Docker"
  ///// Environment and Instances ////
  setting {
    namespace = "aws:autoscaling:launchconfiguration"
    name = "EC2KeyName"
    value = "hhvm-package-builders"
  }
  setting {
    namespace = "aws:autoscaling:launchconfiguration"
    name = "IamInstanceProfile"
    value = "aws-elasticbeanstalk-ec2-role"
  }
  setting {
    namespace = "aws:autoscaling:launchconfiguration"
    name = "InstanceType"
    value = "t3.micro"
  }
  setting {
    namespace = "aws:autoscaling:launchconfiguration"
    name = "SecurityGroups"
    value = aws_security_group.internal.id
  }
  setting {
    namespace = "aws:ec2:vpc"
    name = "VPCId"
    value = aws_vpc.main.id
  }
  setting {
    namespace = "aws:ec2:vpc"
    name = "Subnets"
    value = join(",", [aws_subnet.az_a.id, aws_subnet.az_b.id])
  }
  setting {
    namespace = "aws:ec2:vpc"
    name = "ELBSubnets"
    value = join(",", [aws_subnet.az_a.id, aws_subnet.az_b.id])
  }
  ///// Scaling /////
  setting {
    namespace = "aws:autoscaling:trigger"
    name = "MeasureName"
    value = "Latency"
  }
  setting {
    namespace = "aws:autoscaling:trigger"
    name = "Unit"
    value = "Seconds"
  }
  setting {
    namespace = "aws:autoscaling:trigger"
    name = "LowerThreshold"
    value = "1"
  }
  setting {
    namespace = "aws:autoscaling:trigger"
    name = "UpperThreshold"
    value = "3"
  }
  setting {
    namespace = "aws:autoscaling:asg"
    name = "MinSize"
    value = "1"
  }
  setting {
    namespace = "aws:autoscaling:asg"
    name = "MaxSize"
    value = "4"
  }
  ///// Load Balancing /////
  setting {
    namespace = "aws:elasticbeanstalk:environment"
    name = "EnvironmentType"
    value = "LoadBalanced"
  }
  setting {
    namespace = "aws:elasticbeanstalk:environment"
    name = "LoadBalancerType"
    value = "application"
  }
  setting {
    namespace = "aws:elbv2:loadbalancer"
    name = "ManagedSecurityGroup"
    value = aws_security_group.public.id
  }
  setting {
    namespace = "aws:elbv2:loadbalancer"
    name = "SecurityGroups"
    value = aws_security_group.public.id
  }
  setting {
    namespace = "aws:elbv2:loadbalancer"
    name = "ManagedSecurityGroup"
    value = aws_security_group.public.id
  }
  setting {
    namespace = "aws:elbv2:loadbalancer"
    name = "IPAddressType"
    value =  "dualstack"
  }
  setting {
    namespace = "aws:elbv2:listener:80"
    name = "ListenerEnabled"
    value = "true"
  }
  setting {
    namespace = "aws:elbv2:listener:443"
    name = "ListenerEnabled"
    value = "true"
  }
  setting {
    namespace = "aws:elbv2:listener:443"
    name = "Protocol"
    value = "HTTPS"
  }
  setting {
    namespace = "aws:elbv2:listener:443"
    name = "SSLCertificateArns"
    value = "arn:aws:acm:us-west-2:223121549624:certificate/8f845b56-937f-49b8-adf4-64b69a3caf57"
  }
}

resource "aws_elastic_beanstalk_environment" "docs_a" {
  application = aws_elastic_beanstalk_application.docs.name
  name = "hhvm-hack-docs-vpc-a"
  cname_prefix = "hack-hhvm-docs-vpc-staging"
  template_name = aws_elastic_beanstalk_configuration_template.docs.name
  version_label = "app-1ef9-210727_182110-stage-210727_182110"
}
