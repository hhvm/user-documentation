# Creates a docker image with a built copy of the site. Not repo-auth.
# Useful as a scratch/testing area.
FROM hhvm/hhvm:4.134-latest
ENV TZ UTC
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN rm -rf /var/www
ADD . /var/www

RUN cd /var/www && touch /.docker_build && .deploy/init.sh
