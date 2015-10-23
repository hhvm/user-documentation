# Quickstart to HHVM

If you are new to HHVM, this quickstart guide should help get you up an running quickly. Of course, as this is meant to be a quickstart, not every detail will be provided here. The main [HHVM user guide](..) will be your resource for full information.

## Overview

The infrastructure you need to run code with HHVM is pretty simple:

* HHVM itself
* Some Hack or PHP code

HHVM includes a highly functional and performant webserver called [Proxygen](../deployment/hhvm-servers#proxygen) that is default out of the box, so no installation of a third-party web server like `nginx` is required. However, if you are migrating to HHVM from a PHP runtime engine, and you were already using `nginx` or `apache`, and possibly FastCGI, there are [detailed instructions](../deployment/hhvm-servers#fastcgi) on getting that set up as well. 

When a user makes a request for a PHP script on your server, proxygen will terminate the HTTP request and then make a request to HHVM. HHVM will process the request and send a response to proxygen, which will then send the response to the original client. This process generally mirrors how php-fpm configurations work (except with HHVM instead of PHP5 on the back end of course), if you're familiar with that.

For this setup, although various flavors of Debian, Ubuntu are supported with [official packages](../installation/intro.md#prebuilt-packages), the most recent [Ubuntu LTS](../installation/linux.md#obtaining-lts-releases) and the most recent [Ubuntu stable release](../installation/linux.md#ubuntu-15.04-vivid) are likely to be the *best* supported and easiest to get working. Furthermore, although any webserver, such as Apache or nginx, is supported, for simplicity this overview will talk only about proxygen (since it is built in directly with HHVM). Again, feel free to read the [full docs](../deployment/hhvm-servers#proxygen) to figure out how to get nginx or Apache working.

## Install HHVM

Refer to [our directions on installing a prebuilt package](../installation/linux.md). For example, if you are running Ubuntu 15.04, and you want the latest stable release, you would run the following:

```
sudo apt-get install software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository 'deb http://dl.hhvm.com/ubuntu vivid main'
sudo apt-get update
sudo apt-get install hhvm
```

If you want the latest [LTS (long term support)](../installation/intro.md#lts-releases) release, you follow the same instructions as above, except append `-lts-<version>` to the `deb` line above:

```
sudo apt-get-repository 'deb http://dl.hhvm.com/ubuntu-lts-3.9 vivid main'
```

Generally, the `hhvm` executable is available in `/usr/bin`, and that will be in your `$PATH`, so you can type `hhvm` to run HHVM at the command-line. But, your distro could be different; so verify the location of `hhvm` on your distro.

You can [build from source](../installation/intro.md) if you really want, but doing that doesn't include nice things like our init script or automatic updates via `apt-get`, and so isn't recommended until you get a basic install working and have a better feel for what you're doing.

Installing HHVM will start it up now, but it won't be configured to start at next boot. `sudo update-rc.d hhvm defaults` will set that up.

## Test HHVM

After installing HHVM, it should automatically be running in server mode. If it is not, you can start it up by:

```
hhvm -m server -d hhvm.server.port=8080 -d hhvm.server.source_root=/var/www/public
```

You can choose any port you want (80 is the default, so if you want that, then you do not need to specify the option), and you can choose any source root (place where the code will run from) you want (the default directory for proxygen is the current directory where the `hhvm` process was launched; we
gave it an explicit value above).

You do not need to add `-d hhvm.server.type=proxygen` since that is the default.

Write a simple "Hello World" program named `hello.php`:

```
<?php
echo "Hello World!\n";
```

and put the `hello.php` in `/var/www/public`.

Now load [http://localhost/hello.php](http://localhost:8080/hello.php) or `curl http://localhost:8080/hello.php` and verify you see "Hello world".

## Configure HHVM

The out-of-the-box HHVM configuration won't need tweaking by most new users. Notably, the fancy JIT that gives HHVM its speed is on by default. If you want to take a look at the configuration, it's at `/etc/hhvm/php.ini` and `/etc/hhvm/server.ini`.

The only really interesting option for new users is in `server.ini`, the `hhvm.log.file` option, to control where your error logs go if the server hits a fatal error or similar. By default it's set to `/var/log/hhvm/error.log`.

## The Hack language

The above will allow you to run Hack code as well; the only extra step is to make sure you are [running the `hh_client` typechecker](../../guides/hack/typechecker/intro.md) otherwise you'll be missing out on a lot of your type errors in your Hack code!

## Learning PHP and Hack

Actually learning to program in PHP or Hack is beyond the scope of this documentation. The best resource is the [official Hack documentation](../../guides/hack/quickstart.md). There is also an awesome [book on HHVM and Hack](http://www.amazon.com/Hack-HHVM-Programming-Productivity-Breaking/dp/1491920874/), written by an engineer on the HHVM team. For PHP, [PHP's documentation](http://docs.php.net/manual/en/getting-started.php) contains an introduction to PHP, and there are numerous tutorials online. [Hack has an online interactive tutorial](http://hacklang.org/tutorial/) as well.
