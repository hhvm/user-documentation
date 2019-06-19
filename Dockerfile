FROM hhvm/hhvm-proxygen:4.10-latest
ARG DOCKER_BUILD_ENV=prod
ENV TZ UTC

# We need a unicode-aware system to generate the docs
# Not needed for HHVM >= 3.19, as 3.19 is built on Ubuntu 16.04, which has a
# different locale system
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get clean && apt-get update -y && apt-get install -y locales && locale-gen en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN rm -rf /var/www
ADD . /var/www

# HHVM currently tries to init numa, which indirectly calls set_mempolicy(); as
# set_mempolicy is banned by Docker's default profile, stub out libnuma
ENV LD_PRELOAD /var/www/container-bin/numa_stub.so

RUN touch /docker_build && cd /var/www && container-bin/init.sh

# Make the webserver port accessible outside the container
EXPOSE 80
