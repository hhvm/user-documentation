We currently have **experimental support** for HHVM installations on Mac OS X 10.10 and greater. We use [Homebrew](http://brew.sh/), with both an official formula and hand-install option. There is also a [Macports](https://www.macports.org/) option.

We **reiterate** ... this support should work, but is experimental.

## Homebrew Formula

```
brew tap hhvm/hhvm
brew install hhvm
```

And then wait a long time for it to compile since [we don't provide bottles yet](https://github.com/hhvm/homebrew-hhvm/issues/5). (This will be anywhere from twenty minutes on a beefy Mac Pro to a couple of hours on a MacBook Air.)

## Homebrew Install By Hand

### Install compiler

The only supported compiler for HHVM on OS X right now is clang, and the version Apple ships doesn't support TLS.

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

## Macports: Install by Hand

### Dependencies

```
sudo port -v install autoconf automake binutils bison boost clang-3.6 cmake elftoolchain gawk google-glog jemalloc libelf libjpeg-turbo libmcrypt libmemcached libpng md5sha1sum ocaml oniguruma5 readline tbb
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
