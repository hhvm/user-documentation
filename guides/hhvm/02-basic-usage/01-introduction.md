After [installing](../01-installation/01-introduction.md), you are ready to start using HHVM.

For a majority of cases, you will run HHVM in one of two different ways:

* In [command-line](./02-command-line.md) mode to run standalone scripts.
* In [server](./03-server.md) mode, where HHVM will serve web requests from users.

## Default Configuration

The default configuration for HHVM is `php.ini` for command-line mode and `server.ini` for server mode (both normally found in `/etc/hhvm/` on [Linux](../01-installation/02-linux.md) distros) 

The default configurations will be sufficient for a majority of use cases. Thus, you most likely will not need to tweak these INI settings, etc. They will be loaded automatically when you start HHVM.

However, HHVM does allow you to adjust [configuration options](../04-configuration/01-introduction.md) to your liking.
