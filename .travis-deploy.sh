#!/bin/bash
set -e

if [ "${TRAVIS_EVENT_TYPE}" == "cron" ]; then
  exit 0
fi

DEPLOY_REV=$(git rev-parse --short HEAD)
HHVM_VERSION=$(awk '/APIProduct::HACK/{print $NF}' src/codegen/PRODUCT_TAGS.php | cut -f2 -d- | cut -f1-2 -d.)
IMAGE_TAG="HHVM-${HHVM_VERSION}-$(date +%Y-%m-%d)-${DEPLOY_REV}"
IMAGE_NAME=hhvm/user-documentation:$IMAGE_TAG

echo "** Building repo..."
if [ "$(uname -s)" == "Darwin" ]; then
  # MacOS Darwin gives us somewhere Docker doesn't like by default
  REPO_OUT=/tmp/repo-out
else
  REPO_OUT="$(mktemp -d)"
fi
docker run --rm \
  -v "$REPO_OUT:/var/out"  \
  -w /var/www \
  hhvm/user-documentation:scratch \
  .deploy/build-repo.sh

echo "** Building Docker image..."
cp hhvm.prod.ini "$REPO_OUT/"
cp .deploy/prod.Dockerfile "$REPO_OUT/Dockerfile"
(
  cd "$REPO_OUT"
  docker build \
    -t "$IMAGE_NAME" \
    .
)

echo "** Installing ElasticBeanstalk CLI..."

cd $(pyenv root)
git fetch --tags
git checkout v1.2.19

git clone --depth 10 https://github.com/aws/aws-elastic-beanstalk-cli-setup.git
./aws-elastic-beanstalk-cli-setup/scripts/bundled_installer
export PATH="${PYTHONPATH}/bin:${PATH}"

echo "** Logging in to dockerhub..."
echo "${DOCKERHUB_PASSWORD}" | docker login -u "${DOCKERHUB_USER}" \
  --password-stdin
echo "** Pushing image to DockerHub..."
docker tag $IMAGE_NAME hhvm/user-documentation:latest
docker push "$IMAGE_NAME"
docker push "hhvm/user-documentation:latest"

echo "** Setting up ElasticBeanstalk..."
# Select an application to use: 1) hhvm-hack-docs
# Select the default environment: 1) ... doesn't matter, managed by script
# Do you want to continue with CodeCommit? n
echo -e "1\n1\nn\n" | eb init -r us-west-2

echo "** Updating AWS config"
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
docker run --rm \
  -w /var/www \
  -e REMOTE_TEST_HOST=staging.docs.hhvm.com \
  hhvm/user-documentation:scratch \
  vendor/bin/hacktest \
  --filter-groups remote \
 tests/
echo "** Swapping prod and staging..."
eb swap
