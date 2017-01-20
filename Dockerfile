FROM hhvm/hhvm-proxygen:latest
ARG DOCKER_BUILD_ENV=prod
ENV TZ UTC

# We need a unicode-aware system to generate the docs
RUN locale-gen en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

ENV DEBIAN_FRONTEND noninteractive

RUN rm -rf /var/www
ADD . /var/www
RUN touch /docker_build && cd /var/www && container-bin/init.sh

# Make the webserver port accessible outside the container
EXPOSE 80
