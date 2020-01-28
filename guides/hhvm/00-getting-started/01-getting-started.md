If you are new to HHVM, this getting started guide should help get you up an running quickly. Of course, as this is meant to be a getting started, not every detail will be provided here. The main [HHVM user guide](..) will be your resource for full information.

## Overview

The infrastructure you need to run code with HHVM is pretty simple:

* HHVM itself
* Some Hack code

For this setup, although various flavors of Debian and Ubuntu are supported with [official packages](../installation/introduction.md#prebuilt-packages), the most recent [Ubuntu LTS](../installation/linux.md#obtaining-lts-releases) and the most recent [Ubuntu stable release](../installation/linux.md#ubuntu-15.04-vivid) are likely to be the *best* supported and easiest to install.

## Install HHVM

Refer to [our directions on installing a prebuilt package](../installation).

It is of course possible to [build HHVM from source](../installation/building-from-source.md), but this is much more complicated and time consuming. For this reason, building from source isn't recommended until you get a basic install working and have a better feel for what you're doing.

## Test HHVM

After installing HHVM, change to the directory where your code lives, and start up HHVM:

```
hhvm -m server -p 8080
```

`-m` represents the [mode](../basic-usage/introduction.md) and here indicates that HHVM is running in HTTP server mode.

`-p` configures the TCP port that HHVM uses to listen to HTTP requests. The default port is 80, the standard HTTP port. However, that port requires root access, so for this example, we will use port 8080.

Once you have HHVM running, write a simple "Hello World" program named `hello.hack`:

```
<<__EntryPoint>>
function main(): noreturn{
  echo "Hello World!";
  exit(0);
}
```

Save this `hello.hack` in the same directory that you ran the `hhvm` command from above. Then, load [http://localhost:8080/hello.hack](http://localhost:8080/hello.hack) in your browser and verify you see "Hello World!" appear.

## Configure HHVM

The out-of-the-box HHVM configuration won't need tweaking by most new users. Notably, the JIT compiler that gives HHVM its speed is on by default. If you want to take a look at the configuration used, it's at `/etc/hhvm/php.ini`.

Running HHVM automatically at boot as a service (instead of just on the command line as above) unfortunately does require some configuration. See the [proxygen documentation](../basic-usage/proxygen) for details.

## Running Hack files

HHVM runs [Hack](/hack/getting-started/getting-started) code. Hack is Facebook's language that extends the syntax of PHP to offer type-checking as well as numerous [additional language features](/hack/). We created a simple Hack program above when testing HHVM.

To test and run a Hack file, make sure you are running the `hh_client` typechecker; otherwise you'll be missing out on a lot of your type errors in your Hack code.

## Learning Hack and PHP

Learning to program in PHP or Hack is beyond the scope of this guide. The best resource for doing so is the [official Hack documentation](/hack/getting-started/getting-started) and we highly recommend the [O'Reilly book on HHVM and Hack](http://www.amazon.com/Hack-HHVM-Programming-Productivity-Breaking/dp/1491920874/), written by an engineer on the HHVM team at Facebook.

For PHP, [PHP's documentation](http://docs.php.net/manual/en/getting-started.php) contains an introduction to PHP, and there are numerous tutorials online.
