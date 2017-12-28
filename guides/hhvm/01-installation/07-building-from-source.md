Building from source is advisable generally when you need features that exist in our source that are not in a [package](http://beta.docs.hhvm.com/hhvm/installation/introduction#prebuilt-packages). Otherwise, installing from a package is the easiest and most stable way to get up and running.

## Requirements

 - An `x86_64` system
 - GCC 5 or above
 - Several GB of RAM
 - Additional build-time dependencies; these are listed for various distributions in [our packaging repository](https://github.com/hhvm/packaging/) - for example,
   [Debian Jessie's `control` file](https://github.com/hhvm/packaging/blob/master/debian-8-jessie/debian/control) contains the build dependency list. If you are not
   on a distribution we currently target, use Jessie as a starting point: the packages are likely to be similary named.

### GCC 5

If your system comes with an earlier GCC, you must build GCC and G++; we [script a minimal build](https://github.com/hhvm/packaging/blob/master/build-deps/build-gcc) for
several of our binary packages.

HHVM might build with GCC 4.9, however:
 - we are no longer testing this
 - HHVM is [known to trigger optimization bugs in GCC 4.9](https://github.com/facebook/hhvm/issues/8011)

## Downloading the HHVM source-code

```
git clone git://github.com/facebook/hhvm.git --depth=1
cd hhvm
git submodule update --init --recursive
```

## Building HHVM

This will take a *long* time.

```
cmake -DMYSQL_UNIX_SOCK_ADDR=/var/run/mysqld/mysqld.sock .
make -j [number_of_processor_cores] # eg. make -j 4
sudo make install
```

### Custom GCC

If you have built your own GCC, you will need to pass additional options to cmake:

```
-DCMAKE_C_COMPILER=/path/to/gcc -DCMAKE_CXX_COMPILER=/path/to/g++ -DSTATIC_CXX_LIB=On
```

### MacOS

It's fairly common in some environments to work around `opendirectoryd` issues by scheduling a cronjob to kill it; if you're doing this, disable it before building HHVM, or you
are likely to get misleading errors such as `/bin/sh: /bin/sh: cannot execute binary file` in the middle of the build.

Even when building HHVM from source, it's easiest to use [brew](https://brew.sh) to install dependencies and manage the build environment:

```
brew tap hhvm/hhvm
brew deps --include-build hhvm | xargs brew install
brew sh
```

`brew sh` will drop you into a bash shell in a normalized build environment - e.g. `PATH` will be set to include common build tools.

Inside this shell:

```
# Several of our dependencies are not linked into standard places...

# ... some of the `brew sh` wrappers will remove CFLAGS/CXXFLAGS that reference undeclared dependencies
export HOMEBREW_DEPENDENCIES="$(brew deps --include-build hhvm | paste -s -d , -)"
# ... some of those use pkg-config, and we need to tell it where to look:
export PKG_CONFIG_PATH="$(echo "$HOMEBREW_DEPENDENCIES" | tr ',' "\n" | xargs brew --prefix | sed 's,$,/lib/pkgconfig,' | paste -s -d : -)"
# ... for others, CMake directly looks for specific files, and we need to tell it where to look too:
export CMAKE_PREFIX_PATH="$(echo "$HOMEBREW_DEPENDENCIES" | tr ',' "\n" | xargs brew --prefix | paste -s -d : -)"

# Configure.
# - If you install MySQL server from Homebrew, it uses /tmp/mysql.sock as the unix socket by default
# - disable extensions that aren't supported on MacOS
cmake . \
  -DMYSQL_UNIX_SOCK_ADDR=/tmp/mysql.sock \
  -DENABLE_MCROUTER=OFF \
  -DENABLE_EXTENSION_MCROUTER=OFF \
  -DENABLE_EXTENSION_IMAP=OFF
make # you probably want `make -j<number of cores`, e.g. `make -j12`
```

## Running programs

The installed hhvm binary can be found in `/usr/local/bin`.

## Errors

If any errors occur, you may have to remove the `CMakeCache.txt` file in the checkout.

If your failure was on the `make` command, try to correct the error and run `make` again, it should restart from the point it stops. If the error persists, try to remove as explained above.

## Running Tests

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
