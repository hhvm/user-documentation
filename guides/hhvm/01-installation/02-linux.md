We support x86_64 Linux, and offer prebuilt packages on variety of Ubuntu and
Debian platforms.

While you can [build from source](/hhvm/installation/building-from-source), it is generally advisable for ease of installation and stability to use a prebuilt package.

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

## Obtaining A Minor Release

It is generally recommended to follow the newest version possible, provided your codebase is compatible with that version. You can fetch all supported versions (except for HHVM3.30.x) by adding that version to `/etc/apt/sources.list`. The syntax you need is:

`deb https://dl.hhvm.com/<%operating system%> <%operating system version%>-<%major%>.<%minor%>`

So in order to get HHVM4.8 on ubuntu bionic (18.04) you would use
`deb https://dl.hhvm.com/ubuntu bionic-4.8`

You will automatically receive patches such as HHVM 4.8.1, but your won't upgrade to HHVM4.9 and up.

In order to get HHVM3.30 use:
`deb https://dl.hhvm.com/ubuntu bionic-lts-3.30 main`
This is how lts release were previously released.

## Choosing A Version

If you are working on a new project, you can install the newest release version by not specifying a version number like so:
`deb https://dl.hhvm.com/ubuntu bionic main`

If you have an existing project, you can upgrade one release at a time using the [blog](/blog) to read up on breaking changes.

If you are inheriting a project and you don't know what version it was written against, check the composer.json file. This file is usually found at the root of a project (right next to .hhconfig). This file ought to include a version requirement like `"hhvm": "^4.8"`. If not, check the last time a commit was made and find what HHVM version was recent at that time using the [blog](/blog).

Whatever you do, please make sure that your chosen HHVM version is receiving security updates. The [blog](/blog) will inform you on what versions supported.

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
