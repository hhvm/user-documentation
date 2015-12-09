Normally, after installing HHVM, you can use the [sensible defaults](../basic-usage/introduction.md) provided to [run Hack and PHP scripts](../basic-usage/command-line.md) or [run HHVM as a server](../basic-usage/server.md).

While a majority of the time you will not need to tweak the default settings or use the more advanced modes available with HHVM, they are available:

* [Repo Authoritative](./repo-authoritative.md) mode allows you to compile your entire codebase into one unit, allowing for HHVM to perform highly aggressive optimizations to make your code run quickly.
* [Daemon](./daemon.md) mode allows you to run HHVM as a background process.
* The [admin server](./admin-server.md) allows you to monitor HHVM as it is running in server mode.
* [FastCGI](/hhvm/advanced-usage/fastCGI) is another server type for HHVM that is highly configurable and fast, but requires a separate web server on top of it.

## Custom Configuration

There are also a plethora of custom [configuration options](./configuration/introduction.md) that you can set to tweak how HHVM operates when running scripts or running as a server.
