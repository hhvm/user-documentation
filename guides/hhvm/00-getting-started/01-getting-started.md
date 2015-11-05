# Getting Started with HHVM

If you are new to HHVM, this getting started guide should help get you up an running quickly. Of course, as this is meant to be a getting started, not every detail will be provided here. The main [HHVM user guide](..) will be your resource for full information.

## Overview

The infrastructure you need to run code with HHVM is pretty simple:

* HHVM itself
* Some Hack or PHP code

HHVM includes a highly functional and performant web server called [Proxygen](../deployment/hhvm-servers#proxygen) that is available by default out-of-the-box, so no installation of a third-party web server like `nginx` is required. However, if you are migrating to HHVM from a PHP runtime engine, and you were already using `nginx` or `apache`, perhaps with FastCGI, there are [detailed instructions](../deployment/hhvm-servers#fastcgi) on getting those configurations set up as well.

For simplicity, this overview will talk only about Proxygen (since it is built-in to HHVM). When a user makes a request for a PHP script on your server, Proxygen will serve the request to HHVM, which will process the request and return a response via Proxygen to the original client, just as a [`php-fpm`](http://php-fpm.org/) configuration would work with other web servers.

For this setup, although various flavors of Debian and Ubuntu are supported with [official packages](../installation/intro.md#prebuilt-packages), the most recent [Ubuntu LTS](../installation/linux.md#obtaining-lts-releases) and the most recent [Ubuntu stable release](../installation/linux.md#ubuntu-15.04-vivid) are likely to be the *best* supported and easiest to install.

## Install HHVM

Refer to [our directions on installing a prebuilt package](../installation/linux.md). For example, if you are running Ubuntu 15.04, and you want the latest stable release, run the following:

```
sudo apt-get install software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository 'deb http://dl.hhvm.com/ubuntu vivid main'
sudo apt-get update
sudo apt-get install hhvm
```

If you want the latest [LTS (long term support)](../installation/intro.md#lts-releases) release, you follow the same instructions as above, except append `-lts-<version>` to the (third) `deb` line above:

```
sudo apt-get-repository 'deb http://dl.hhvm.com/ubuntu-lts-3.9 vivid main'
```

Generally, the `hhvm` executable will be available in `/usr/bin`, and that will be in your `$PATH`, so, following installation, you should be able to type `hhvm` to run HHVM at the command-line. But different distros may use different paths, so, prior to proceeding, verify the installation location of `hhvm`.

It is of course possible to [build HHVM from source](../installation/intro.md), but you will sacrifice things like the `init` script and automatic updates via `apt-get`. For this reason, building from source isn't recommended until you get a basic install working and have a better feel for what you're doing.

Installing HHVM will start it up, but it won't be configured to start upon reboot. To have HHVM start automatically when your system does, use `sudo update-rc.d hhvm defaults`.

## Test HHVM

After installing HHVM, it should automatically be running in server mode. If it is not, you can start it up using:

```
hhvm -m server -p 8080
```

`-m` represents the [mode](../basic-usage/intro.md) and here indicates that HHVM is running in server mode.

`-p` configures the TCP port that HHVM uses to listen to HTTP requests (80 is the default when not specified). Here we are using 8080 - which is more likely to be available if you have another web server already installed and listening to port 80.

Additional configuration items are passed in with `-d` entries. More details are in [the basic usage guide](../basic-usage/server.md).

For example our simple startup sequence above, HHVM will use [Proxygen](../basic-usage/proxygen.md) as the default server type. However, if other web servers are being used in front of HHVM running in FastCGI mode, you would specify the server type accordingly: `-d hhvm.server.type=fastcgi`.

You can also choose any source root as the directory where the server finds PHP (`<?php`) or Hack (`<?hh`) files and other web assets. The default directory for Proxygen is the *current directory* where the `hhvm` process was launched. Generally, however, you will want to give it an explicit value to your web root with an option like `-d hhvm.server.source_root=/var/www/public`.

Once you have HHVM running, write a simple "Hello World" program named `hello.php`:

```
<?hh
echo "Hello World!";
```

Save this `hello.php` in the same directory that you ran the `hhvm` command from above or whichever folder you specified in `hhvm.server.source_root`.

Now load [http://localhost/hello.php](http://localhost:8080/hello.php) in your browser or `curl http://localhost:8080/hello.php` and verify you see "Hello World!" appear.

## Configure HHVM

The out-of-the-box HHVM configuration won't need tweaking by most new users. Notably, the JIT compiler that gives HHVM its speed is on by default. If you want to take a look at the configuration used, it's at `/etc/hhvm/php.ini` and `/etc/hhvm/server.ini`.

One notable option for new users is `hhvm.log.file` in `server.ini`, which controls where your error logs go if the server hits a fatal error or similar. By default it's set to `/var/log/hhvm/error.log`.

## Running Hack files

HHVM runs both PHP and [Hack](../../guides/hack/getting-started/getting-started.md). Hack is Facebook's language that extends the syntax of PHP to offer type-checking as well as numerous [additional language features](/hack). We created a simple Hack program above when testing HHVM. 

To test and run a Hack file, make sure you are [running the `hh_client` typechecker](../../guides/hack/typechecker/intro.md) otherwise you'll be missing out on a lot of your type errors in your Hack code. The simplest way to make a PHP program a Hack program is to simply change the prolog of the file to `<?hh` to indicate it's Hack. Then you can immediately start benefiting from these features.

## Learning Hack and PHP

Learning to program in PHP or Hack is beyond the scope of this guide. The best resource for doing so is the [official Hack documentation](../../guides/hack/getting-started/getting-started.md) and we highly recommend the [O'Reilly book on HHVM and Hack](http://www.amazon.com/Hack-HHVM-Programming-Productivity-Breaking/dp/1491920874/), written by an engineer on the HHVM team at Facebook. Hack has an [online interactive tutorial](http://hacklang.org/tutorial/) as well.

For PHP, [PHP's documentation](http://docs.php.net/manual/en/getting-started.php) contains an introduction to PHP, and there are numerous tutorials online.
