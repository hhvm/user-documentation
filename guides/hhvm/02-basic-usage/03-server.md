Server mode is how you will use HHVM to serve web requests. The HHVM process starts up and continuously waits to serve web requests.

Multiple requests can, of course, be served simultaneously, and HHVM also caches code to be shared across requests as well.

Here is the simplest way to run HHVM in server mode.

```
% hhvm -m server -p 8080
```

`-m` is the `mode` option; the default is [command-line](./command-line.md).

`-p` is the port where HHVM will listen for requests. The default is 80.

And the root for your program files will be the current directory from where you launched the `hhvm` command above.

## Configuration Overrides

`-d` specifies command-line [configuration](../configuration/introduction.md) overrides.

In our example above, we are using the default HHVM built-in [proxygen](./proxygen.md) web server on port 8080.

We could have removed the `-p 8080` and explicitly appended:

`-d hhvm.server.type=proxygen -d hhvm.server.port=8080 -d hhvm.server.source_root=./`

to the command above. While this is a more verbose way to accomplish the same command, there might be reasons to be explicit. And, of course, you can change various [other settings](../configuration/introduction.md) with `-d` as well.

HHVM will also use the default INI configuration `server.ini` (normally found in `/etc/hhvm/` in [Linux](../installation/linux.md) distros).

## Client access to HHVM in server mode

Normally, a web request of the form:

```
http://your.site:8080/index.php
```

You can also use `curl` and other programs to access the HHVM server as well.

### Possible Fatal Error

If the code you are running is written in [Hack (<?hh)](/hack/) and you run into a [fatal error regarding not running the typechecker](/hhvm/FAQ/faq#running-code__how-do-i-fix-the-not-running-the-hack-typechecker-fatal-error), then you must do one of the following:

- Create an empty file named `.hhconfig` in the root directory of your source code.
- Or pass `-d hhvm.hack.lang.look_for_typechecker=0` to the `hhvm -m server...` command you used above.
