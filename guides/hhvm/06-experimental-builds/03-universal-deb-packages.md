We also provide prebuilt universal deb packages, which do not depend on system libraries and are expected to run on any version of Debian, Ubuntu or any other Linux distributions with `apt` package manager.

## Obtaining The Latest Release Version

``` bash
apt-get update &&
apt-get install --yes software-properties-common apt-transport-https &&
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94 &&
add-apt-repository 'deb https://dl.hhvm.com/universal release main' &&
apt-get update &&
apt-get install --yes hhvm &&
hhvm --version
```

## Obtaining A Specific Release Branch

``` bash
apt-get update &&
apt-get install --yes software-properties-common apt-transport-https &&
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94 &&
add-apt-repository 'deb https://dl.hhvm.com/universal release-4.167 main' &&
apt-get update &&
apt-get install --yes hhvm &&
hhvm --version
```

The apt suite name can be any version as
`release-x.yyy` since 4.167, where `x` is the major version and `yyy` is the minor version.

## Obtaining The Nightly Version

``` bash
apt-get update &&
apt-get install --yes software-properties-common apt-transport-https &&
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94 &&
add-apt-repository 'deb https://dl.hhvm.com/universal nightly main' &&
apt-get update &&
apt-get install --yes hhvm &&
hhvm --version
```

## Known Issue

Note that the universal deb packages are built with nix package manager and then
get repacked into deb format. As a result, the universal deb packages will
conflict with packages directly installed from the nix package manager. If you
are a nix package manager user, you should directly use the [nix packages](./nix-packages.md),
instead of the universal deb packages in case of path conflicts.
