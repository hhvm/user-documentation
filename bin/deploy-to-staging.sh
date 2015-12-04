#!/bin/bash
set -e

if [ ! -e Dockerrun.aws.json ]; then
  echo "Run from root directory of checkout"
  exit 1
fi

export TZ=America/Los_Angeles
DEPLOY_REV=$(git rev-parse --short HEAD)
IMAGE_TAG=$(date +%Y-%m-%d)-$DEPLOY_REV
IMAGE_NAME=hhvm/user-documentation:$IMAGE_TAG

echo "** Building image"
docker build -t $IMAGE_NAME $(pwd)
docker tag -f $IMAGE_NAME hhvm/user-documentation:latest # add an alias
echo "** Pushing image to dockerhub"
docker push $IMAGE_NAME
docker push hhvm/user-documentation:latest # push the alias too

echo "** Updating AWS config"
## Update AWS config file
# mac sed doesn't support -i
SEDTEMP=$(mktemp)
sed 's_"hhvm/user-documentation:[^"]\+"_"'$IMAGE_NAME'"_' Dockerrun.aws.json > $SEDTEMP
cat $SEDTEMP > Dockerrun.aws.json
rm $SEDTEMP

git commit \
  -m "[autocommit] AWS deploy $IMAGE_TAG" \
  Dockerrun.aws.json

echo "** Identifying environments"
if eb status hhvm-hack-docs-a | grep -q 'CNAME: hhvm-hack-docs-staging.elasticbeanstalk.com'; then
  STAGING_ENV=hhvm-hack-docs-a
else
  STAGING_ENV=hhvm-hack-docs-b
fi

echo "** About to deploy to $STAGING_ENV"

eb status $STAGING_ENV

DEPLOY_MESSAGE="$(git log -1 --oneline $DEPLOY_REV)"
echo "**    eb deploy $STAGING_ENV -m $DEPLOY_MESSAGE"
eb deploy $STAGING_ENV -m "$DEPLOY_MESSAGE"
echo "** Running test suite against staging:"
echo "**     ./bin/test-staging.sh"
./bin/test-staging.sh
echo "** To switch over prod, run 'eb swap'"
