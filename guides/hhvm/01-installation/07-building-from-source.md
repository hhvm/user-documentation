```yamlmeta
{
  "caution": [
    "HHVM will no longer support homebrew on MacOS going forward. For more information, see [Stopping MacOS Homebrew Support](https://hhvm.com/blog/2022/06/17/deprecating-homebrew.html)."
  ]
}
```

Building from source is advisable generally when you need features that exist in our source that are not in a [package](/hhvm/installation/introduction#prebuilt-packages). Otherwise, installing from a package is the easiest and most stable way to get up and running.

## Requirements

- An `x86_64` system
- Several GB of RAM
- MacOS:
  - Sierra or High Sierra
  - Clang from Xcode Command Line Tools
- Linux:
  - GCC 7+
  - we only actively support building on distributions we create binary packages for; your mileage may vary on other systems

We only support building with the bundled OCaml; you may need to uninstall
(or `brew unlink` on Mac) other ocamlc and ocamlbuild binaries before
building HHVM.

## Installing Build Dependencies

### Debian or Ubuntu

If you haven't already added our apt repositories (e.g. to install binary packages):

```
$ apt-get update
$ apt-get install software-properties-common apt-transport-https
$ apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94
```

To install the build dependencies:

```
$ add-apt-repository -s https://dl.hhvm.com/debian
# - or - #
$ add-apt-repository -s https://dl.hhvm.com/ubuntu

$ apt-get update
$ apt-get build-dep hhvm-nightly
```

### Homebrew

```
$ brew tap hhvm/hhvm
$ brew deps --include-build hhvm | xargs brew install
```

### Other Distributions

It's best to obtain the dependency list from our nightly packaging system, to ensure you're using an
up-to-date list; to do this, search https://github.com/hhvm/packaging/ for `Build-Depends:`

## Downloading the HHVM source-code

```
git clone git://github.com/facebook/hhvm.git
cd hhvm
git submodule update --init --recursive
```

## Building HHVM

This will take a *long* time.

```
mkdir build
cd build
cmake -DMYSQL_UNIX_SOCK_ADDR=/var/run/mysqld/mysqld.sock ..
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

Even when building HHVM from source, it's easiest to use [brew](https://brew.sh) to manage the build environment:

```
$ brew sh
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
# - Make sure that CMake uses Homebrew's preferred OSX SDK
# - set installation prefix for installing side-by-side with homebrew versions (optional)

mkdir build
cd build
cmake .. \
  -DMYSQL_UNIX_SOCK_ADDR=/tmp/mysql.sock \
  -DCMAKE_OSX_SYSROOT=${HOMEBREW_SDKROOT} \
  -DCMAKE_INSTALL_PREFIX=${HOMEBREW_CELLAR}/hhvm-local/$(date +%Y.%m.%d)
make # you probably want `make -j<number of cores`, e.g. `make -j12`
make install
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
