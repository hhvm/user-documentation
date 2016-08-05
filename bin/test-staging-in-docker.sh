#!/bin/bash

set -e

if [ -z "$DOCKER_IMAGE" ]; then
  echo "DOCKER_IMAGE environment variable must be set"
  exit 1
fi

docker run 
