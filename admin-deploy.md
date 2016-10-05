# Deploying The Site (for admins only)

## DockerHub

The site is deployed from DockerHub - this is used both by the production AWS instance, and local copies.

 - Sign up for https://hub.docker.com/
 - Get an existing owner of the hhvm to add you to the 'owners' team so that you can push new images to `hhvm/user-documentation`

## Configuring Docker

  - Install Docker following the instructions on [their website](https://www.docker.com/products/overview) - not Homebrew or similar
  - run 'docker login', and enter your DockerHub credentials
  - if you are on Linux, add yourself to the 'docker' group (`sudo usermod -aG docker $(whoami)`), log out, and log in again

## Install the AWS tools

You need both the standard AWS tools, and the 'EB' (elastic beanstalk) tools.

 - if you are using Homebrew on OSX, `brew install awscli` and `brew install awsebcli`
 - otherwise, see Amazon's instructions for [the AWS CLI](http://docs.aws.amazon.com/cli/latest/userguide/installing.html) and [the EB cli](http://docs.aws.amazon.com/elasticbeanstalk/latest/dg/eb-cli3-install.html)

## Create AWS accounts

Our AWS login page is at https://fb-oss.signin.aws.amazon.com - first, get an existing admin to create an admin account for you:

 - go to IAM (Identity & Access Mangement)
 - Create a new user (usually `yourfbunixname`)
 - Set a password, and tick 'require user to change their password on next login'
 - Enable two-factor authentication (aka multi-factor authentication, MFA); you can use the Duo app on your phone, or a hardware device if one is available. We generally recommend a hardware device as resetting MFA is a pain with AWS, and neccessary if your phone is lost, upgraded, wiped, or restored from backup.
 - Add this account to the 'admins' group
 - **NEVER** create API keys for this account

You should then login as your new admin account, and create yourself a less privileged account:

 - go to IAM
 - Create a new user (usually `yourfbunixname_non_admin`)
 - **DO NOT** set a password or associate a two-factor device
 - You'll then be given an API keypair
 - Open up another tab, and go to IAM again
 - Add the new user to the 'EB-hhvm-docs' group
 - Open a terminal
 - run `aws configure` and enter the API credentials IAM gave you in the first tab; leave the other options at their default
 - close both tabs, and remove any other copies of those new credentials

## Set up the documentation repo

 - clone it from github
 - open a terminal, and go to the 'user-documentation' repo
 - run `eb init` - you want the us-west-2 region and the existing hhvm-docs app; you'll also be prompted for -a vs -b - it doesn't matter which you pick

## Deploying the site to staging

Run `bin/deploy-to-staging.sh` - this will:

 - build a docker image containing the fully built site
 - run the full test suite inside the docker image
 - push the image to dockerhub
 - make a git commit updating the version in the AWS config
 - deploy it to staging.docs.hhvm.com
 - run a partial test suite remotely against staging.docs.hhvm.com (search the tests for `@group remote` to see what this does)
 - tell you the next steps :)
