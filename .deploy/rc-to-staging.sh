#!/bin/bash
set -e
IS_MACOS=false
if [ "$(uname -s)" == Darwin ]; then
  IS_MACOS=true
fi

if [ ! -e Dockerrun.aws.json.in ]; then
  echo "Run from root directory of checkout"
  exit 1
fi

if ! git diff --quiet; then
  echo "** Uncommitted changes, refusing to run:"
  echo
  git status
  exit 1
fi

export TZ=America/Los_Angeles
DEPLOY_REV=$(git rev-parse --short HEAD)
HHVM_VERSION=$(awk '/APIProduct::HACK/{print $NF}' src/codegen/PRODUCT_TAGS.php | cut -f2 -d- | cut -f1-2 -d.)
IMAGE_TAG="HHVM-${HHVM_VERSION}-$(date +%Y-%m-%d)-${DEPLOY_REV}"
IMAGE_NAME=hhvm/user-documentation:$IMAGE_TAG

docker tag hhvm/user-documentation:rc $IMAGE_NAME

echo "** Pushing image to dockerhub"
docker push $IMAGE_NAME
docker push hhvm/user-documentation:latest # push the alias too

echo "** Updating AWS config"
## Update AWS config file
sed -E 's,"hhvm/user-documentation:IMAGE_TAG","'$IMAGE_NAME'",' \
  Dockerrun.aws.json.in > Dockerrun.aws.json

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
echo "**    docker run $IMAGE_NAME /var/www/container-bin/test-staging.sh"
docker run $IMAGE_NAME /var/www/container-bin/test-staging.sh
echo "** Next steps:"
echo "**  - $ eb swap # swaps staging.docs.hhvm.com and docs.hhvm.com; this"
echo "**      also be used to revert a bad push"
