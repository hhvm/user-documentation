# Supported Linux Distributions

We support prebuilt packages and compiling from source on variety of Ubuntu and Debian platforms. It is generally advisable for ease of installation and stability to use a prebuilt package.

Here are the supported distributions:

* [Ubuntu 14.04](#ubuntu-14.04-trusty)
* [Ubuntu 14.10](#ubuntu-14.10-utopic)
* [Ubuntu 15.04](#ubuntu-15.04-vivid)
* [Debian 8](#debian-8-wheezy)
* [Debian 7](#debian-7-jessie)

## Obtaining LTS Releases

The prebuilt packages below will get you the latest stable point release of HHVM. If you want an [LTS release](./intro#lts-releases), then append `-lts` and the LTS version in the `deb` line.

e.g., the following `deb` line in `/etc/apt/sources.list` will get all stable updates on Ubuntu 14.04 "trusty":

    deb http://dl.hhvm.com/ubuntu trusty main

In order to get only LTS updates in the 3.3 series, change that to:

    deb http://dl.hhvm.com/ubuntu trusty-lts-3.3 main

## Ubuntu 14.04 Trusty

### Prebuilt Package

```
# installs add-apt-repository
sudo apt-get install software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
# Living on the edge (rebuilt everyday, unstable)
sudo apt-get install hhvm-nightly
# Segfaults in the nightly
sudo apt-get install hhvm-nightly-dbg
```

### Compilation

*Packages Installation*

> **Please Note:** You must be running a 64-bit OS to compile & install HHVM.

Using sudo or as root user: (it is recommended that you run `sudo apt-get update` and `sudo apt-get upgrade` first, or you may receive errors)

```
sudo apt-get install autoconf automake binutils-dev build-essential cmake g++ gawk git \
  libboost-dev libboost-filesystem-dev libboost-program-options-dev libboost-regex-dev \
  libboost-system-dev libboost-thread-dev libboost-context-dev libbz2-dev libc-client-dev libldap2-dev \
  libc-client2007e-dev libcap-dev libcurl4-openssl-dev libdwarf-dev libelf-dev \
  libexpat-dev libgd2-xpm-dev libgoogle-glog-dev libgoogle-perftools-dev libicu-dev \
  libjemalloc-dev libmcrypt-dev libmemcached-dev libmysqlclient-dev libncurses-dev \
  libonig-dev libpcre3-dev libreadline-dev libtbb-dev libtool libxml2-dev zlib1g-dev \
  libevent-dev libmagickwand-dev libinotifytools0-dev libiconv-hook-dev libedit-dev \
  libiberty-dev libxslt1-dev ocaml-native-compilers libsqlite3-dev libyaml-dev libgmp3-dev \
  gperf libkrb5-dev libnotify-dev
```

*Downloading the HHVM source-code*

```
git clone git://github.com/facebook/hhvm.git --depth=1
cd hhvm
git submodule update --init --recursive
```

*Building HHVM*

Please ensure that your machine has more than 1GB of RAM. Expect a long compilation time if you are compiling on a virtual machine with one virtual core.

```
cmake -DMYSQL_UNIX_SOCK_ADDR=/var/run/mysqld/mysqld.sock .
make -j [number_of_processor_cores] # eg. make -j 4
sudo make install
```

*Running programs*

The installed hhvm binary can be found in `/usr/local/bin`.

*Errors*

If any errors occur, you may have to remove the `CMakeCache.txt` file in the checkout. 

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If the error persists, try to remove as explained above.

*Running Tests*

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

## Ubuntu 14.10 Utopic

### Prebuilt Package

```
# installs add-apt-repository
sudo apt-get install software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository 'deb http://dl.hhvm.com/ubuntu utopic main'
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
# Living on the edge (rebuilt everyday, unstable)
sudo apt-get install hhvm-nightly
# Segfaults in the nightly
sudo apt-get install hhvm-nightly-dbg
```

### Compilation

*Packages Installation*

> **Please Note:** You must be running a 64-bit OS to compile & install HHVM.

Using sudo or as root user: (it is recommended that you run `sudo apt-get update` and `sudo apt-get upgrade` first, or you may receive errors)

```
sudo apt-get install autoconf automake binutils-dev build-essential cmake g++ gawk git \
  libboost-dev libboost-filesystem-dev libboost-program-options-dev libboost-regex-dev \
  libboost-system-dev libboost-thread-dev libboost-context-dev libbz2-dev libc-client-dev libldap2-dev \
  libc-client2007e-dev libcap-dev libcurl4-openssl-dev libdwarf-dev libelf-dev \
  libexpat-dev libgd2-xpm-dev libgoogle-glog-dev libgoogle-perftools-dev libicu-dev \
  libjemalloc-dev libmcrypt-dev libmemcached-dev libmysqlclient-dev libncurses-dev \
  libonig-dev libpcre3-dev libreadline-dev libtbb-dev libtool libxml2-dev zlib1g-dev \
  libevent-dev libmagickwand-dev libinotifytools0-dev libiconv-hook-dev libedit-dev \
  libiberty-dev libxslt1-dev ocaml-native-compilers libsqlite3-dev libyaml-dev libgmp3-dev \
  gperf libkrb5-dev libnotify-dev
```

*Downloading the HHVM source-code*

```
git clone git://github.com/facebook/hhvm.git --depth=1
cd hhvm
git submodule update --init --recursive
```

*Building HHVM*

Please ensure that your machine has more than 1GB of RAM. Expect a long compilation time if you are compiling on a virtual machine with one virtual core.

```
cmake -DMYSQL_UNIX_SOCK_ADDR=/var/run/mysqld/mysqld.sock .
make -j [number_of_processor_cores] # eg. make -j 4
sudo make install
```

*Running programs*

The installed hhvm binary can be found in `/usr/local/bin`.

*Errors*

If any errors occur, you may have to remove the `CMakeCache.txt` file in the checkout. 

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If the error persists, try to remove as explained above.

*Running Tests*

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

### Prebuilt Package

```
# installs add-apt-repository
sudo apt-get install software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository 'deb http://dl.hhvm.com/ubuntu vivid main'
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
# Living on the edge (rebuilt everyday, unstable)
sudo apt-get install hhvm-nightly
# Segfaults in the nightly
sudo apt-get install hhvm-nightly-dbg
```

### Compilation

*Packages Installation*

> **Please Note:** You must be running a 64-bit OS to compile & install HHVM.

Using sudo or as root user: (it is recommended that you run `sudo apt-get update` and `sudo apt-get upgrade` first, or you may receive errors)

```
sudo apt-get install autoconf automake binutils-dev build-essential cmake g++ gawk git \
  libboost-dev libboost-filesystem-dev libboost-program-options-dev libboost-regex-dev \
  libboost-system-dev libboost-thread-dev libboost-context-dev libbz2-dev libc-client-dev libldap2-dev \
  libc-client2007e-dev libcap-dev libcurl4-openssl-dev libdwarf-dev libelf-dev \
  libexpat-dev libgd2-xpm-dev libgoogle-glog-dev libgoogle-perftools-dev libicu-dev \
  libjemalloc-dev libmcrypt-dev libmemcached-dev libmysqlclient-dev libncurses-dev \
  libonig-dev libpcre3-dev libreadline-dev libtbb-dev libtool libxml2-dev zlib1g-dev \
  libevent-dev libmagickwand-dev libinotifytools0-dev libiconv-hook-dev libedit-dev \
  libiberty-dev libxslt1-dev ocaml-native-compilers libsqlite3-dev libyaml-dev libgmp3-dev \
  gperf libkrb5-dev libnotify-dev
```

*Downloading the HHVM source-code*

```
git clone git://github.com/facebook/hhvm.git --depth=1
cd hhvm
git submodule update --init --recursive
```

*Building HHVM*

Please ensure that your machine has more than 1GB of RAM. Expect a long compilation time if you are compiling on a virtual machine with one virtual core.

```
cmake -DMYSQL_UNIX_SOCK_ADDR=/var/run/mysqld/mysqld.sock .
make -j [number_of_processor_cores] # eg. make -j 4
sudo make install
```

*Running programs*

The installed hhvm binary can be found in `/usr/local/bin`.

*Errors*

If any errors occur, you may have to remove the `CMakeCache.txt` file in the checkout. 

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If the error persists, try to remove as explained above.

*Running Tests*

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

## Debian 8 Wheezy

### Prebuilt Package

```
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/debian jessie main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
# Living on the edge (rebuilt everyday, unstable)
sudo apt-get install hhvm-nightly
# Segfaults in the nightly
sudo apt-get install hhvm-nightly-dbg
```

### Compilation

*Packages installation*

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
  automake libldap2-dev libkrb5-dev libyaml-dev gperf ocaml-native-compilers
```

*Getting HHVM source-code*

```
mkdir dev
cd dev
git clone git://github.com/facebook/hhvm.git --depth=1
export CMAKE_PREFIX_PATH=`pwd`
```

*Building HHVM*

```
cd hhvm
git submodule update --init --recursive
cmake .
make
```

*Running programs*

The hhvm binary can be found in `hphp/hhvm/hhvm`.

*Errors*

If any errors occur, it may be required to remove the `CMakeCache.txt` directory in the checkout. 

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If don't, try to remove as explained above.

## Debian 7 Jessie

### Prebuilt Package

```
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/debian wheezy main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
# Living on the edge (rebuilt everyday, unstable)
sudo apt-get install hhvm-nightly
# Segfaults in the nightly
sudo apt-get install hhvm-nightly-dbg
```

### Compilation

Building HHVM on Debian 7 is no longer supported; we require GCC 4.8, which is newer than the included version. You can find instructions for unsupported platforms [here](LINK HERE).

## Deprecated Support

The following distributions are only supported for [LTS releases](./intro#lts-releases) up to 3.6.

### Ubuntu 10.04 Lucid

*HHVM 3.3 only*

```
sudo add-apt-repository ppa:ubuntu-toolchain-r/test
wget -O - http://dl.hhvm.com/conf/hhvm.gpg.key | sudo apt-key add -
echo deb http://dl.hhvm.com/ubuntu lucid main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install gcc-4.8 g++-4.8 gcc-4.8-base
sudo apt-get install hhvm
```

### Ubuntu 12.04 Precise

*HHVM 3.6 only*

```
# If this command is not found then do this: sudo apt-get install python-software-properties
sudo add-apt-repository ppa:mapnik/boost
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/ubuntu precise main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
```

Don't forget to Install Boost 1.49 on Ubuntu 12.04. See [Building and Installing HHVM on Ubuntu 12.04](https://github.com/facebook/hhvm/wiki/Building-and-installing-HHVM-on-Ubuntu-12.04#installing-boost-149) for details.

### Mint 16 Preta

*HHVM 3.6 only*

```
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/mint petra main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
```

If this repo is slow for you, choose a different [[Mirror]].

If you get the following error when trying to run hhvm:

```
hhvm: error while loading shared libraries: libboost_program_options.so.1.49.0: cannot open shared object file: No such file or directory
```

you may be able to fix it by simply installing the required packages (hhvm package incorrectly installs libboost 1.53):

```
sudo apt-get install libboost-filesystem1.49.0 libboost-program-options1.49.0 libboost-regex1.49.0 libboost-thread1.49.0
```

## Mirrors 

There are a variety of volunteered owned mirrors to get the packages, if the default one shown in these instructions are slow. Just change the prefix in your `/etc/apt/sources.list.d/hhvm.list` (still leave the subdirectory of your distro).

* http://dl.hhvm.com/ (US)
* http://mirror.yourwebhoster.eu/hhvm/ (NL)
* http://mirror.mephi.ru/hhvm/ (RU)
* http://hhvm.bauerj.eu/ (DE)
* http://mirrors.noc.im/hhvm/ (CN)
