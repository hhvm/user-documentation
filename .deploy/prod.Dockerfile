# Creates a docker image with a built copy of the site. Not repo-auth.
# Useful as a scratch/testing area.
FROM hhvm/hhvm-proxygen:4.15-latest

ADD hhvm.prod.ini /etc/hhvm/site.ini
ADD hhvm.hhbc /var/www/hhvm.hhbc
ADD file.cache /var/www/file.cache

EXPOSE 80
