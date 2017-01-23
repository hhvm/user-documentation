We publish Docker images to Docker Hub.  These can be used to install HHVM in a containerized environment.  If you are new to Docker follow their [getting started guide](https://docs.docker.com/engine/getstarted/) to learn more.  All of our images are available [here](https://hub.docker.com/u/hhvm/) (including one for this doc site).  To get you started here is a hello world example.

Start by creating the following files and folders in a directory:

*`Dockerfile`*

```
FROM hhvm/hhvm-proxygen:latest

RUN rm -rf /var/www
ADD . /var/www

EXPOSE 80
```

*`public/index.php`*

```
<?php
echo "Hello World!";
```


Now in a shell run:

```
docker build .
docker run -p 0.0.0.0:80:80 <Replace With The Hash Identifying The Build>
```

You should now have a running web server hosting the *`index.php`* script visit http://localhost/ to check it out.  To shut it down run:

```
docker ps
docker stop <The CONTAINER ID shown in the output from docker ps>
```
