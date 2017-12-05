We support x86_64 Linux, and offer prebuilt packages on variety of Ubuntu and
Debian platforms.

While you can [build from source](/hhvm/installation/building-from-source), it is generally advisable for ease of installation and stability to use a prebuilt package.

Here are the supported distributions:

* Ubuntu 16.04 Xenial
* Ubuntu 16.10 Yakkety
* Ubuntu 17.04 Zesty
* Ubunty 17.10 Artful
* Debian 7 Wheezy
* Debian 8 Jessie
* Debian 9 Stretch

## Ubuntu

```
sudo apt-get install software-properties-common apt-transport-https
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

sudo add-apt-repository https://dl.hhvm.com/ubuntu
sudo apt-get update
sudo apt-get install hhvm
```

## Debian 8 Jessie, Debian 9 Stretch

```
sudo apt-get install -y apt-transport-https software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

sudo add-apt-repository https://dl.hhvm.com/debian
sudo apt-get update
sudo apt-get install hhvm
```

## Debian 7 Wheezy

```
sudo apt-get install -y apt-transport-https software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

echo deb https://dl.hhvm.com/debian wheezy main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```

## Obtaining LTS Releases

The commands above will get you the latest stable point release of HHVM. If you want an [LTS release](/hhvm/installation/introduction#prebuilt-packages__lts-releases), then append `-lts` and the LTS version in the `deb` line.

e.g., the following `deb` line in `/etc/apt/sources.list` will get all stable updates on Ubuntu 16.04 "Xenial":

    deb https://dl.hhvm.com/ubuntu xenial main

In order to get only LTS updates in the 3.15 series, change that to:

    deb https://dl.hhvm.com/ubuntu xenial-lts-3.15 main

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
* http://mirror.mephi.ru/hhvm/ (RU)
* https://hhvm.bauerj.eu/ (DE)
