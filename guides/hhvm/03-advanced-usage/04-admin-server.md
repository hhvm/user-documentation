# Admin Server

The admin server allows the administrator of the HHVM server to query and control the HHVM server process. It is different and separate than the primary HHVM server that you specified with `-m server` or `-m daemon`.

To turn on the admin server, you specify the following options at the command line via `-d` or within your `server.ini` (or equivalent).

```
hhvm.admin_server.port=9001
hhvm.admin_server.password=SomePassword
```

The `port` can be any open port. And you should **always specify a password** to secure the admin port since you don't want just anybody being able to control your server. In fact, you will probably want to put the admin server *behind a firewall*. You will specify the password with every request to the admin port.

In [FastCGI](./fastcgi.md) mode, a FastCGI server, fronted with a web server like nginx, will be listening to the admin port, while in [Proxygen](../basic-usage/proxygen.md) mode, it will be an HTTP server.

## Querying the Admin Server

Once you have set up your admin server, you can query it via `curl`. 

```
curl http://localhost:9001/
```

will bring up a list of commands you can use to control and query your admin server. Use one of these command with your password.

```
curl http://localhost:9001/compiler-id?auth=SomePassword
```
