# Creates a docker image with a built copy of the site. Not repo-auth.
# Useful as a scratch/testing area.
FROM hhvm/hhvm:4.68-latest
ARG DOCKER_BUILD_ENV=prod
ENV TZ UTC
ENV DEBIAN_FRONTEND noninteractive
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN rm -rf /var/www
ADD . /var/www

RUN touch /docker_build && cd /var/www && .deploy/init.sh
