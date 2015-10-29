# Server Mode

Server mode is how you will use HHVM to serve web requests. The HHVM process starts up and continuously waits to serve web requests.

Multiple requests can, of course, be served simultaneously, and HHVM also caches code to be shared across requests as well.

Here is the simplest way to run HHVM in server mode.

```
% hhvm -m server -d hhvm.server.type=proxygen -d hhvm.server.port=8080
```

`-m` is the `mode` option; the default is [command-line](./command-line.md).

`-d` specifies command-line configuration overrides. Here were are using the HHVM built-in [proxygen](./proxygen.md) web server on port 8080.

And HHVM will use the default INI configuration `server.ini` (normally found in `/etc/hhvm/` in [Linux](../installation/linux.md) distros).

## Client access to HHVM in server mode

Normally, a web request of the form:

```
http://your.site:8080/index.php
```

You can also use `curl` and other programs to access the HHVM server as well.
