# Proxygen Webserver

HHVM has built-in support for two server types: Proxygen and [FastCGI](../advanced-usage/fastcgi).

Proxygen is a full web server built directly into HHVM, and is recommended since it is generally the easiest to get up and running. It serves web requests *fast*.  Proxygen provides you a high performance web server that is equivalent to what something like the combination of FastCGI and nginx might provide.

## Using Proxygen

**NOTE**: We are looking into making Proxygen the default web server for HHVM out of the box (i.e., it will be set in the default `server.ini` file). This should hopefully come soon.

To use Proxygen when running HHVM in server mode:

```
hhvm -m server -d hhvm.server.type=proxygen -d hhvm.server.port=8080
```

Your port can be whatever you want, of course.

## Example Proxygen Configuration

While not as configurable as a FastCGI/nginx combination, Proxygen does provide sensible defaults for many applications. Thus the simple Proxygen startup sequence above will be just fine.

However, here is an example of some possible configuration options that you could also add/change to your `server.ini` or as `-d` options at the command line:

```
; some of these are not necessary since they are the default value, but
; they are good to show for illustration, and sometimes it is good for
; documentation purposes to be explicit anyway.
; hhvm.server.source_root and hhvm.server.port are the most likely ones
; that need explicit values.
hhvm.server.port = 80
hhvm.server.type = proxygen
hhvm.server.default_document = index.php
hhvm.server.error_document404 = index.php
; default is the current directory where you launched the HHVM binary
hhvm.server.source_root=/var/www/public
```
