We support x86_64 Linux, and offer prebuilt packages on variety of Ubuntu and
Debian platforms.

While you can [build from source](/hhvm/installation/building-from-source), it is generally advisable for ease of installation and stability to use a prebuilt package.

Here are the supported distributions:

* [Ubuntu 14.04](#ubuntu-14.04-trusty)
* [Ubuntu 15.04](#ubuntu-15.04-vivid)
* [Ubuntu 15.10](#ubuntu-15.10-wily-werewolf)
* [Debian 7](#debian-7-wheezy)
* [Debian 8](#debian-8-jessie)

## Ubuntu 14.04 Trusty

```
# installs add-apt-repository
sudo apt-get install software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
sudo apt-get update
sudo apt-get install hhvm
```

## Ubuntu 15.04 Vivid

```
# installs add-apt-repository
sudo apt-get install software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
sudo apt-get update
sudo apt-get install hhvm
```

## Ubuntu 15.10 Wily Werewolf

```
# installs add-apt-repository
sudo apt-get install software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
sudo apt-get update
sudo apt-get install hhvm
```

## Debian 7 Wheezy

```
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/debian wheezy main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```

## Debian 8 Jessie

```
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/debian jessie main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```

## Obtaining LTS Releases

The commands above will get you the latest stable point release of HHVM. If you want an [LTS release](/hhvm/installation/introduction#prebuilt-packages__lts-releases), then append `-lts` and the LTS version in the `deb` line.

e.g., the following `deb` line in `/etc/apt/sources.list` will get all stable updates on Ubuntu 14.04 "trusty":

    deb http://dl.hhvm.com/ubuntu trusty main

In order to get only LTS updates in the 3.9 series, change that to:

    deb http://dl.hhvm.com/ubuntu trusty-lts-3.9 main

## Other Packages

The above commands all install the standard `hhvm` package, which is the stable, release configuration. We have a few other packages available in the repo as well:

```
# Stable debug build that is suitable for debuggers like gdb
sudo apt-get install hhvm-dbg

# Stable developer package that contains the headers so you can create extensions, etc.
sudo apt-get install hhvm-dev

# Nightly build (Living on the edge, rebuilt everyday, possibly unstable)
sudo apt-get install hhvm-nightly

# Nightly debug build
sudo apt-get install hhvm-nightly-dbg

# Nightly developer build
sudo apt-get install hhvm-dev-nightly

```

## Mirrors

There are a variety of volunteered owned mirrors to get the packages, if the default one shown in these instructions are slow. Just change the prefix in your `/etc/apt/sources.list.d/hhvm.list` (still leave the subdirectory of your distro).

* http://dl.hhvm.com/ (US)
* http://mirror.yourwebhoster.eu/hhvm/ (NL)
* http://mirror.mephi.ru/hhvm/ (RU)
* http://hhvm.bauerj.eu/ (DE)
* http://mirrors.noc.im/hhvm/ (CN)
