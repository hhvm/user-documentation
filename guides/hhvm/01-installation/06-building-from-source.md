Building from source is advisable generally when you need features that exist in our source that are not in a [package](http://beta.docs.hhvm.com/hhvm/installation/introduction#prebuilt-packages). Otherwise, installing from a package is the easiest and most stable way to get up and running.

You must be running a 64-bit OS to compile & install HHVM. Here are the supported distributions for compiling from source:

* [Ubuntu 14.04](#ubuntu-14.04-trusty)
* [Ubuntu 15.04](#ubuntu-15.04-vivid)
* [Debian 8](#debian-8-jessie)
* [Mac OS X Homebrew](#mac-os-x-homebrew)
* [Mac OS X Macports](#mac-os-x-macports)
* [Unsupported](#unsupported)

## Ubuntu 14.04 Trusty

### Packages Installation

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

### Packages Installation

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
  automake libldap2-dev libkrb5-dev libyaml-dev gperf ocaml-native-compilers
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

This requires Mac OS X 10.10 or higher.

### Install compiler

The only supported compiler for HHVM on OS X right now is clang, and the version Apple ships doesn't support TLS, so we need to build our own.

```
brew install llvm --with-clang
```

### Install dependencies

```
brew install freetype gettext cmake libtool mcrypt oniguruma  \
             autoconf libelf readline automake md5sha1sum \
             gd icu4c libmemcached pkg-config tbb imagemagick \
             libevent sqlite openssl glog boost lz4 pcre \
             gawk jemalloc ocaml gmp dwarfutils libzip
```

### Get HHVM

```
git clone --recursive git://github.com/facebook/hhvm.git
```

### Build HHVM

```
cd hhvm
cmake . \
    -DCMAKE_CXX_COMPILER=$(brew --prefix llvm)/bin/clang++ \
    -DCMAKE_C_COMPILER=$(brew --prefix llvm)/bin/clang \
    -DCMAKE_ASM_COMPILER=$(brew --prefix llvm)/bin/clang \
    -DCMAKE_C_FLAGS="-I$(brew --prefix readline)/include -L$(brew --prefix readline)/lib" \
    -DCMAKE_CXX_FLAGS="-I$(brew --prefix readline)/include -L$(brew --prefix readline)/lib" \
    -DENABLE_MCROUTER=OFF \
    -DENABLE_EXTENSION_MCROUTER=OFF \
    -DENABLE_EXTENSION_IMAP=OFF \
    -DMYSQL_UNIX_SOCK_ADDR=/tmp/mysql.sock \
    -DLIBEVENT_LIB=$(brew --prefix libevent)/lib/libevent.dylib \
    -DLIBEVENT_INCLUDE_DIR=$(brew --prefix libevent)/include \
    -DICU_INCLUDE_DIR=$(brew --prefix icu4c)/include \
    -DICU_LIBRARY=$(brew --prefix icu4c)/lib/libicuuc.dylib \
    -DICU_I18N_LIBRARY=$(brew --prefix icu4c)/lib/libicui18n.dylib \
    -DICU_DATA_LIBRARY=$(brew --prefix icu4c)/lib/libicudata.dylib \
    -DREADLINE_INCLUDE_DIR=$(brew --prefix readline)/include \
    -DREADLINE_LIBRARY=$(brew --prefix readline)/lib/libreadline.dylib \
    -DBOOST_INCLUDEDIR=$(brew --prefix boost)/include \
    -DBOOST_LIBRARYDIR=$(brew --prefix boost)/lib \
    -DJEMALLOC_INCLUDE_DIR=$(brew --prefix jemalloc)/include \
    -DJEMALLOC_LIB=$(brew --prefix jemalloc)/lib/libjemalloc.dylib \
    -DLIBINTL_LIBRARIES=$(brew --prefix gettext)/lib/libintl.dylib \
    -DLIBINTL_INCLUDE_DIR=$(brew --prefix gettext)/include \
    -DLIBDWARF_LIBRARIES=$(brew --prefix dwarfutils)/lib/libdwarf.a \
    -DLIBDWARF_INCLUDE_DIRS=$(brew --prefix dwarfutils)/include \
    -DLIBMAGICKWAND_INCLUDE_DIRS=$(brew --prefix imagemagick)/include/ImageMagick-6 \
    -DLIBMAGICKWAND_LIBRARIES=$(brew --prefix imagemagick)/lib/libMagickWand-6.Q16.dylib \
    -DFREETYPE_INCLUDE_DIRS=$(brew --prefix freetype)/include/freetype2 \
    -DFREETYPE_LIBRARIES=$(brew --prefix freetype)/lib/libfreetype.dylib \
    -DLIBMEMCACHED_LIBRARY=$(brew --prefix libmemcached)/lib/libmemcached.dylib \
    -DLIBMEMCACHED_INCLUDE_DIR=$(brew --prefix libmemcached)/include \
    -DLIBELF_LIBRARIES=$(brew --prefix libelf)/lib/libelf.a \
    -DLIBELF_INCLUDE_DIRS=$(brew --prefix libelf)/include/libelf \
    -DLIBGLOG_LIBRARY=$(brew --prefix glog)/lib/libglog.dylib \
    -DLIBGLOG_INCLUDE_DIR=$(brew --prefix glog)/include \
    -DOPENSSL_SSL_LIBRARY=$(brew --prefix openssl)/lib/libssl.dylib \
    -DOPENSSL_INCLUDE_DIR=$(brew --prefix openssl)/include \
    -DOPENSSL_CRYPTO_LIBRARY=$(brew --prefix openssl)/lib/libcrypto.dylib \
    -DCRYPT_LIB=$(brew --prefix openssl)/lib/libcrypto.dylib \
    -DTBB_INSTALL_DIR=$(brew --prefix tbb) \
    -DLIBSQLITE3_INCLUDE_DIR=$(brew --prefix sqlite)/include \
    -DLIBSQLITE3_LIBRARY=$(brew --prefix sqlite)/lib/libsqlite3.0.dylib \
    -DLIBZIP_INCLUDE_DIR_ZIP=$(brew --prefix libzip)/include \
    -DLIBZIP_INCLUDE_DIR_ZIPCONF=$(brew --prefix libzip)/lib/libzip/include \
    -DLIBZIP_LIBRARY=$(brew --prefix libzip)/lib/libzip.dylib \
    -DLZ4_INCLUDE_DIR=$(brew --prefix lz4)/include \
    -DLZ4_LIBRARY=$(brew --prefix lz4)/lib/liblz4.dylib \
    -DPCRE_INCLUDE_DIR=$(brew --prefix pcre)/include \
    -DPCRE_LIBRARY=$(brew --prefix pcre)/lib/libpcre.dylib \
    -DSYSTEM_PCRE_HAS_JIT=1
make -j4 hhvm
```

### Run Tests

```
cd hphp
./hhvm/hhvm test/run test/quick
```

## Mac OS X Macports

Using Macports is unsupported, but should work and require Mac OS X 10.10 or higher.

### Dependencies

```
sudo port -v install autoconf automake binutils bison boost clang-3.6 cmake \
  elftoolchain gawk google-glog jemalloc libelf libjpeg-turbo libmcrypt \
  libmemcached libpng md5sha1sum ocaml oniguruma5 readline tbb
```

### Clone HHVM

```
git clone https://github.com/facebook/hhvm.git
cd hhvm
git submodule update --init --recursive
```

### Build

```
cmake \
 -DCMAKE_C_COMPILER=clang-mp-3.6 -DCMAKE_CXX_COMPILER=clang++-mp-3.6 -DCMAKE_ASM_COMPILER=clang-mp-3.6 \
 -DCMAKE_C_FLAGS="-isystem/opt/local/include" -DCMAKE_CXX_FLAGS="-isystem/opt/local/include" \
 -DENABLE_MCROUTER=0 -DENABLE_EXTENSION_MCROUTER=Off -DENABLE_EXTENSION_IMAGICK=Off \
 -DMYSQL_UNIX_SOCK_ADDR=/dev/null \
 -DLIBDWARF_LIBRARIES="/opt/local/lib/elftoolchain/libdwarf.3.dylib" \
 -DLIBDWARF_INCLUDE_DIRS="/opt/local/include/elftoolchain/"
```

### Run

```
./hphp/hhvm/hhvm --version
```

## Unsupported

There is a [wiki](https://github.com/facebook/hhvm/wiki/Building-and-Installing-HHVM) on the HHVM source code GitHub repo that discusses unsupported distributions on which you may be able to compile HHVM.
