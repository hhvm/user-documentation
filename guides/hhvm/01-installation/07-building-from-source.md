Building from source is advisable generally when you need features that exist in our source that are not in a [package](http://beta.docs.hhvm.com/hhvm/installation/introduction#prebuilt-packages). Otherwise, installing from a package is the easiest and most stable way to get up and running.

You must be running a 64-bit OS to compile & install HHVM. Here are the supported distributions for compiling from source:

* [Ubuntu 14.04](#ubuntu-14.04-trusty)
* [Ubuntu 15.04](#ubuntu-15.04-vivid)
* [Ubuntu 15.10](#ubuntu-15.10-wily-werewolf)
* [Ubuntu 16.04](#ubuntu-16.04-xenial)
* [Ubuntu 16.10](#ubuntu-16.10-yakkety)
* [Debian 8](#debian-8-jessie)
* [Mac OS X Homebrew](#mac-os-x-homebrew)
* [Unsupported](#unsupported)

## Ubuntu 14.04 Trusty

> **Please Note:** You must be running a 64-bit OS to compile & install HHVM.
>
### Packages Installation

Using sudo or as root user: (it is recommended that you run `sudo apt-get update` and `sudo apt-get upgrade` first, or you may receive errors)

```
sudo apt-get install autoconf automake binutils-dev bison build-essential cmake g++ gawk git \
  libboost-dev libboost-filesystem-dev libboost-program-options-dev libboost-regex-dev \
  libboost-system-dev libboost-thread-dev libboost-context-dev libbz2-dev libc-client-dev libldap2-dev \
  libc-client2007e-dev libcap-dev libcurl4-openssl-dev libdwarf-dev libelf-dev \
  libexpat-dev libgd2-xpm-dev libgoogle-glog-dev libgoogle-perftools-dev libicu-dev \
  libjemalloc-dev libmcrypt-dev libmemcached-dev libmysqlclient-dev libncurses-dev \
  libonig-dev libpcre3-dev libreadline-dev libtbb-dev libtool libxml2-dev zlib1g-dev \
  libevent-dev libmagickwand-dev libinotifytools0-dev libiconv-hook-dev libedit-dev \
  libiberty-dev libxslt1-dev ocaml-native-compilers libsqlite3-dev libyaml-dev libgmp3-dev \
  gperf libkrb5-dev libnotify-dev libpq-dev
```

### Downloading the HHVM source-code

```
git clone git://github.com/facebook/hhvm.git --depth=1
cd hhvm
git submodule update --init --recursive
```

### Building HHVM

Please ensure that your machine has more than 1GB of RAM. Expect a long compilation time if you are compiling on a virtual machine with one virtual core.

```
cmake -DMYSQL_UNIX_SOCK_ADDR=/var/run/mysqld/mysqld.sock .
make -j [number_of_processor_cores] # eg. make -j 4
sudo make install
```

### Running programs

The installed hhvm binary can be found in `/usr/local/bin`.

### Errors

If any errors occur, you may have to remove the `CMakeCache.txt` file in the checkout.

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If the error persists, try to remove as explained above.

### Running Tests

If you want to run the regression tests, you will first need to install some locales.  These locales should be sufficient, although may be more than are actually needed:

```
  sudo locale-gen en_EN
  sudo locale-gen en_UK
  sudo locale-gen en_US
  sudo locale-gen en_GB
  sudo locale-gen de_DE
  sudo locale-gen fr_FR
  sudo locale-gen fa_IR
  sudo locale-gen zh_CN.utf8
  sudo locale-gen zh_CN
```

There are 2 families of regression tests. There are about 5000 tests in all. All tests should pass. It takes about 100 CPU minutes to run them all, but the test runner will run them in parallel, using 1 thread per core:

```
  pushd hphp
    test/run quick
    test/run slow
  popd
```

## Ubuntu 15.04 Vivid

Same instructions as [Ubuntu 14.04](#ubuntu-14.04-trusty)

## Ubuntu 15.10 Wily Werewolf

Same instructions as [Ubuntu 14.04](#ubuntu-14.04-trusty)

## Ubuntu 16.04 Xenial

Same instructions as [Ubuntu 14.04](#ubuntu-14.04-trusty)

## Ubuntu 16.10 Yakkety

We currently have issues building on GCC 6.  To downgrade to GCC 5 do:
```
sudo apt-get install gcc-5 g++-5
sudo update-alternatives --install /usr/bin/gcc gcc /usr/bin/gcc-5 40 --slave /usr/bin/g++ g++ /usr/bin/g++-5
sudo update-alternatives --install /usr/bin/gcc gcc /usr/bin/gcc-6 40 --slave /usr/bin/g++ g++ /usr/bin/g++-6
sudo update-alternatives --config gcc
```
Same instructions as [Ubuntu 14.04](#ubuntu-14.04-trusty)

## Debian 8 Jessie

### Packages installation

```
apt-get install git-core cmake gawk libmysqlclient-dev \
  libxml2-dev libmcrypt-dev libicu-dev openssl build-essential binutils-dev \
  libcap-dev zlib1g-dev libtbb-dev libonig-dev libpcre3-dev \
  autoconf libtool libcurl4-openssl-dev wget memcached \
  libreadline-dev libncurses5-dev libmemcached-dev libbz2-dev \
  libc-client2007e-dev php5-mcrypt php5-imagick libgoogle-perftools-dev \
  libcloog-ppl-dev libelf-dev libdwarf-dev libunwind8-dev subversion \
  libtbb2 g++-4.8 gcc-4.8 libjemalloc-dev \
  libc6-dev libmpfr4 libgcc1 binutils \
  libc6 libc-dev-bin libc-bin libgomp1 \
  libstdc++-4.8-dev libstdc++6 \
  libarchive13 cmake-data libacl1 libattr1 \
  g++ cpp gcc make libboost-thread1.55.0 \
  libboost-thread-dev libgd2-xpm-dev \
  pkg-config libboost-system1.55-dev libboost-context1.55-dev \
  libboost-program-options1.55-dev libboost-filesystem1.55-dev libboost-regex1.55-dev \
  libmagickwand-dev libiberty-dev libevent-dev libxslt-dev libgoogle-glog-dev \
  automake libldap2-dev libkrb5-dev libyaml-dev gperf ocaml-native-compilers libpq-dev
```

### Getting HHVM source-code

```
mkdir dev
cd dev
git clone git://github.com/facebook/hhvm.git --depth=1
export CMAKE_PREFIX_PATH=`pwd`
```

### Building HHVM

```
cd hhvm
git submodule update --init --recursive
cmake .
make
```

### Running programs

The hhvm binary can be found in `hphp/hhvm/hhvm`.

### Errors

If any errors occur, it may be required to remove the `CMakeCache.txt` directory in the checkout.

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If don't, try to remove as explained above.

## Mac OS X Homebrew

This requires MacOS 10.12 or higher.

```
brew tap hhvm/hhvm
brew install hhvm
```

This will take a very long time; we hope to provide binaries for MacOS in the future.
