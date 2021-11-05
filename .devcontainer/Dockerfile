FROM hhvm/hhvm-proxygen:4.134-latest

ARG WORKSPACE

RUN rm -rf /var/www; ln -s ${WORKSPACE} /var/www
RUN ln -sf /var/www/hhvm.dev.ini /etc/hhvm/site.ini
RUN touch /docker_build
