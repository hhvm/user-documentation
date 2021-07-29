resource "aws_elastic_beanstalk_environment" "docs_staging" {
  application = aws_elastic_beanstalk_application.docs.name
  name = "hhvm-hack-docs-vpc-staging"
  cname_prefix = "hack-hhvm-docs-vpc-staging"
  template_name = aws_elastic_beanstalk_configuration_template.docs.name
  version_label = "app-1ef9-210727_182110-stage-210727_182110"
}
