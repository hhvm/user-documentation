We support x86_64 Linux, and offer prebuilt packages on variety of Ubuntu and
Debian platforms.

While you can [build from source](/hhvm/installation/building-from-source), it is generally advisable for ease of installation and stability to use a prebuilt package.

Here are the supported distributions:

| Distribution | HHVM 3.21 | HHVM 3.24 | Nightlies |
|--------------|-----------|-----------|-----------|
| Debian 7 Wheezy | Yes | Yes | No |
| Debian 8 Jessie | Yes | Yes | Yes |
| Debian 9 Stretch | No | Yes | Yes|
| Ubuntu 14.04 Trusty | Yes | Yes | Yes |
| Ubuntu 16.04 Xenial | Yes | Yes | Yes |
| Ubuntu 17.10 Artful | No | Yes | Yes |
| Ubuntu 18.04 Bionic | No | No | Yes |

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

## GPG Key Installation: Alternative Method

If you encounter issues with the `apt-key adv` command, an alternative is:

```
apt-get install -y curl
curl https://dl.hhvm.com/conf/hhvm.gpg.key | apt-key add -
apt-key finger 'opensource+hhvm@fb.com'
```

The 'fingerprint' shown by `apt-key finger` (the second line) should exactly match `0583 41C6 8FC8 DE60 17D7  75A1 B411 2585 D386 EB94`; for example:

```
$ apt-key finger 'opensource+hhvm@fb.com'
pub   rsa4096 2017-11-03 [SC]
      0583 41C6 8FC8 DE60 17D7  75A1 B411 2585 D386 EB94
uid           [ unknown] HHVM Package Signing <opensource+hhvm@fb.com>
```

If this is not the case, run `apt-key list`, then use `apt-key del` to remove any keys you don't recognize.

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

Additionally, the [Oregon State University Open Source Lab](https://osuosl.org) maintain a mirror, available
via HTTP, FTP, and rsync, at https://ftp.osuosl.org/pub/hiphop/.

The OSUOSL mirror has limited retention of nightly builds.
