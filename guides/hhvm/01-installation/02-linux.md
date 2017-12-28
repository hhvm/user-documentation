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

These instructions require root; use `su -` or `sudo -i` to get a root shell first.

## Ubuntu

```
apt-get update
apt-get install software-properties-common apt-transport-https
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

add-apt-repository https://dl.hhvm.com/ubuntu
apt-get update
apt-get install hhvm
```

## Debian 8 Jessie, Debian 9 Stretch

```
apt-get update
apt-get install -y apt-transport-https software-properties-common
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

add-apt-repository https://dl.hhvm.com/debian
apt-get update
apt-get install hhvm
```

## Debian 7 Wheezy

```
apt-get update
apt-get install -y apt-transport-https software-properties-common
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94

echo deb https://dl.hhvm.com/debian wheezy main > /etc/apt/sources.list.d/hhvm.list
apt-get update
apt-get install hhvm
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
apt-get install hhvm-dbg

# Stable developer package that contains the headers so you can create extensions, etc.
apt-get install hhvm-dev

# Nightly build (Living on the edge, rebuilt everyday, possibly unstable)
apt-get install hhvm-nightly

# Nightly debug build
apt-get install hhvm-nightly-dbg

# Nightly developer build
apt-get install hhvm-dev-nightly

```

## Mirrors

dl.hhvm.com is fronted by a global CDN, so should be fast for all users. If you wish to maintain a local mirror, you can use AWS CLI utilities to sync:

```
aws s3 sync \
  --no-sign-request \
  --region us-west-2 \
  s3://hhvm-downloads/ \
  ./localpath/ \
  --exclude '*index.html'
```
