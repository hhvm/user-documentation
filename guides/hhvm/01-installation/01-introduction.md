HHVM is officially supported on most major [linux platforms](./linux.md). There is experimental, hope-to-be official support on [Mac OS X 10.10](./mac.md). And work is being done to support [HHVM on Windows](./windows.md).

## Prebuilt Packages

The easiest way to get going with HHVM is to use one of our supported prebuilt packages. Currently prebuilt packages are available for:

* [Ubuntu 16.10 (Yakkety)](./linux.md#ubuntu-16.10-yakkety)
* [Ubuntu 16.04 (Xenial)](./linux.md#ubuntu-16.04-xenial)
* [Ubuntu 15.10 (Wily Werewolf)](./linux.md#ubuntu-15.10-wily-werewolf)
* [Ubuntu 15.04 (Vivid)](./linux.md#ubuntu-15.04-vivid)
* [Ubuntu 14.04 (Trusty)](./linux.md#ubuntu-14.04-trusty)
* [Debian 8 (Jessie)](./linux.md#debian-8-jessie)
* [Debian 7 (Wheezy)](./linux.md#debian-7-wheezy)

### LTS Releases

HHVM releases a point (stable) release on the order of every 8 weeks. Every third major point release of HHVM (e.g, 3.6, 3.9) is considered a long-term support (LTS) release. These releases are supported for around one year (~48 weeks), and are backported with critical bug fixes and security patches. At any given time, there will be two supported LTS releases.

LTS Version | Release Date | End of Support
------------|--------------|---------------
3.12 | 29 January 2016 | 14 February 2017
3.15 | 7 September 2016 | 31 July 2017
3.18 | 14 February 2017 | 15 January 2018
3.21 | 31 July 2017 | 2 July 2018

In addition to the normal stable packages, there are supported [LTS releases](/hhvm/installation/linux#obtaining-lts-releases) for the above distributions.

See our [blog post](http://hhvm.com/blog/6083/hhvm-long-term-support) regarding LTS releases.

## Compiling HHVM

For normal usage, using a [prebuilt package](#prebuilt-packages) is the best course of action for ease of installation and stability. However, if you want to live on the bleeding edge and get the latest and greatest code as it is checked into [GitHub](https://github.com/facebook/hhvm/), you can compile HHVM straight from source. Check the [compilation instructions](/hhvm/installation/building-from-source) for both the supported Linux and Mac OS X distros.

If we support a prebuilt package for a distribution, we support [compiling](/hhvm/installation/building-from-source) it from source as well.

### Hack Typechecker

Whether you are using a [prebuilt package](#prebuilt-packages) or compiling from source, the [Hack Typechecker](/hack/typechecker/introduction) is also part of the installation of HHVM, provided that you have **OCaml 4.03** or greater installed on your distribution. In general, you should be able to `apt-get` or `yum` install OCaml for your distribution.

## Unsupported Distributions

There are wikis of unsupported HHVM platforms for [packages](https://github.com/facebook/hhvm/wiki/Prebuilt-Packages-for-HHVM) and [compilation](https://github.com/facebook/hhvm/wiki/Building-and-Installing-HHVM) as well.
