After [installing](../installing/introduction.md), you are ready to start using HHVM.

For a majority of cases, you will run HHVM in one of two different ways:

* In [command-line](./command-line.md) mode to run standalone scripts.
* In [server](./server.md) mode, where HHVM will serve web requests from users.

## Default Configuration

The default configuration for HHVM is `php.ini` for command-line mode and `server.ini` for server mode (both normally found in `/etc/hhvm/` on [Linux](../installation/linux.md) distros) 

The default configurations will be sufficient for a majority of use cases. Thus, you most likely will not need to tweak these INI settings, etc. They will be loaded automatically when you start HHVM.

However, HHVM does allow you to adjust [configuration options](../configuration/introduction.md) to your liking.
