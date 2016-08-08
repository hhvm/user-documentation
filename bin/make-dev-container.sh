#!/bin/bash
# This takes a while; it builds a production environment then converts it
# to be useful for development. As the process for building the production
# environment cleans up after itself, this means that we need to re-install
# the dev dependencies, so we're installing all the dependencies and
# building the site twice in total.
set -e

if [ ! -e Dockerrun.aws.json ]; then
  echo "Run from root directory of checkout"
  exit 1
fi

IMAGE="hhvm-docs-dev/$(id -nu)"

echo "** Building Docker image..."
docker build -t $IMAGE --build-arg DOCKER_BUILD_ENV=dev $(pwd)
echo "** Starting image..."
CONTAINER_ID=$(docker run -d -v $(pwd):/var/www -p 8080:80 $IMAGE)
CONTAINER_NAME=$(docker inspect --format='{{.Name}}' $CONTAINER_ID | \
  cut -f2- -d/);
echo "    Created container '$CONTAINER_NAME'"

echo "** Restoring build environment..."
docker exec $CONTAINER_NAME \
  /bin/bash /var/www/container-bin/make-dev-environment.sh
echo "** DONE!"

cat <<EOF
The webserver is accessible at:
  http://localhost:8080
To view the HHVM logs:
  docker logs -f $CONTAINER_NAME
To get a shell in your container:
  docker exec -it $CONTAINER_NAME /bin/bash -l
To stop your container:
  docker stop $CONTAINER_NAME
To start your container:
  docker start $CONTAINER_NAME

Handy tips:
 - You can modify files directly in $(pwd) and they will be reflected in the
   container.
 - Build commands should be ran in a container shell.
 - hh_client should be ran in a container shell.
 - Composer is available in the container at /opt/composer/composer.phar
EOF
