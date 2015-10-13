# Introduction to Installing HHVM

HHVM is officially supported on most major [linux platforms](./linux.md). There is experimental, hope-to-be official support on [Mac OS X 10.10](./mac.md). And work is being done to support [HHVM on Windows](./windows.md). 

There is a [wiki of unsupported HHVM platforms](LINK HERE) as well.

## Prebuilt Packages

The easiest way to get going with HHVM is to use one of our supported prebuilt packages. Currently prebuilt packages are available for:

* [Ubuntu 15.04 (Vivid)](./linux.md#ubuntu-15.04-vivid)
* [Ubuntu 14.10 (Utopic)](./linux.md#ubuntu-14.10-utopic)
* [Ubuntu 14.04 (Trusty)](./linux.md#ubuntu-14.04-trusty)
* [Debian 8 (Wheezy)](./linux.md#debian-8-wheezy)
* [Debian 7 (Jessie)](./linux.md#debian-7-jessie)

### LTS Releases

HHVM releases a point (stable) release on the order of every 8 weeks. Every third major point release of HHVM (e.g, 3.6, 3.9) is considered a long-term stable (LTS) release. These releases are supported for nearly one year (48 weeks), and are backported with critical bug fixes and security patches. At any given time, there will be two supported LTS releases.

LTS Version | Release Date | End of Support
------------|--------------|---------------
3.6 | 11 March 2015 | 28 Jan 2016
3.9 | 14 Aug 2015 | 15 July 2016
3.12 | 29 Jan 2016 | 30 Dec 2016 

In addition to the above [prebuilt packages](#prebuilt-packages), there are currently LTS releases for:

* [Ubuntu 10.04 (Lucid)](./linux.md#ubuntu-10.04-lucid)
* [Ubuntu 12.04 (Precise)](./linux.md#ubuntu-12.04-precise)
* [Mint 16 (Preta)](./linux.md#mint-16-preta)

However, LTS support for these three distributions will end on January 28, 2016, when support for HHVM 3.6 LTS ends.

## Compiling HHVM

For normal usage, using a [prebuilt package](#prebuilt-packages) is the best course of action for ease of installation and stability. However, if you want to live on the bleeding edge and get the latest and greatest code as it is checked into [GitHub](https://github.com/facebook/hhvm/), you can compile HHVM straight from source.

If we support a prebuilt package for a distribution, we support compiling it from source as well.

### Hack Typechecker

Whether you are using a [prebuilt package](#prebuilt-packages) or compiling from source, the [Hack Typechecker](../../guides/hack/typechecker/intro.md) is also part of the installation of HHVM, provided that you have **OCaml 3.12** or greater installed on your distribution. In general, you should be able to `apt-get` or `yum` install OCaml for your distribution.
