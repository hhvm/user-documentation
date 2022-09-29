## Overview

The prebuilt nix packages of HHVM are distributed as binary cache of a nix flake. To install HHVM via nix:

1. Install nix package manager
2. Configure nix to enable flake and set up binary cache
3. Install the HHVM package, or build it from source if the binary cache is not available

Currently the nix packages are built and tested on x64 Linux.

## For NixOS Users

For NixOS users, add the following settings to `/etc/nixos/configuration.nix` to
configure the binary cache for HHVM:

``` nix
nix.settings.substituters = [ "s3://hhvm-nix-cache?region=us-west-2&endpoint=hhvm-nix-cache.s3-accelerate.amazonaws.com" ];
nix.settings.trusted-substituters = [ "s3://hhvm-nix-cache?region=us-west-2&endpoint=hhvm-nix-cache.s3-accelerate.amazonaws.com" ];
nix.settings.trusted-public-keys = [ "hhvm-nix-cache-1:MvKxscw16fAq6835oG8sbRgTGITb+1xGfYNhs+ee4yo=" ];
nix.settings.experimental-features = [ "nix-command" "flakes" ];
environment.systemPackages = [
  pkgs.git # Required to support git+https protocol
];
```


In addition, if you want to build HHVM from source, add the following setting to
disable sandboxing because HHVM cannot be built in Nix's sandboxing build
environment.


``` nix
nix.settings.sandbox = false;
```


Then execute the following shell command to apply the configuration to the
system:


``` bash
nixos-rebuild switch
```

Then add HHVM to system packages, 

``` nix
environment.systemPackages = [
  (builtins.getFlake "git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/tags/nightly-2022.09.28").packages.x86_64-linux.default
  pkgs.git
];
```

and apply the configuration, again:


```
nixos-rebuild switch
```


Now hhvm is available.


```
hhvm --version
```



```
HipHop VM 4.169.0-dev (rel) (non-lowptr)
Compiler: 1657256394_118415120
Repo schema: 9845ff37f3bb751abbb48e4c823aa5641d5cb453
```


The above configuration has been tested on NixOS unstable and 22.11. The
configuration for older NixOS might be different.


## For Linux Users Other Than NixOS

For Linux users other than NixOS, the HHVM Nix package can be installed with the
following command if you have a [multi-user installation of
Nix](https://nixos.org/download.html#nix-install-linux):


``` bash
(
sudo tee -a /etc/nix/nix.conf <<EOF
extra-experimental-features = nix-command flakes
extra-substituters = s3://hhvm-nix-cache?region=us-west-2&endpoint=hhvm-nix-cache.s3-accelerate.amazonaws.com
extra-trusted-substituters = s3://hhvm-nix-cache?region=us-west-2&endpoint=hhvm-nix-cache.s3-accelerate.amazonaws.com
extra-trusted-public-keys = hhvm-nix-cache-1:MvKxscw16fAq6835oG8sbRgTGITb+1xGfYNhs+ee4yo=
sandbox = false
EOF
) &&
sudo systemctl restart nix-daemon &&
nix profile install 'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/tags/nightly-2022.09.28' &&
hhvm --version
```


Or if you have a [single-user installation of
Nix](https://nixos.org/download.html#nix-install-linux):


``` bash
(
cat >> ~/.config/nix/nix.conf <<EOF
extra-experimental-features = nix-command flakes
extra-substituters = s3://hhvm-nix-cache?region=us-west-2&endpoint=hhvm-nix-cache.s3-accelerate.amazonaws.com
extra-trusted-substituters = s3://hhvm-nix-cache?region=us-west-2&endpoint=hhvm-nix-cache.s3-accelerate.amazonaws.com
extra-trusted-public-keys = hhvm-nix-cache-1:MvKxscw16fAq6835oG8sbRgTGITb+1xGfYNhs+ee4yo=
sandbox = false
EOF
) &&
nix profile install 'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/tags/nightly-2022.09.28' &&
hhvm --version
```

The above configuration is tested on Nix 2.9.1. The configuration for older Nix
might be different.

## Specifying HHVM Versions

The HHVM version to install is specified in the optional `ref` parameter in the
URL, which can be any git branch or tag. For example:

* To install the latest development version of HHVM
    * `nix profile install
      'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1'`
* To install HHVM nightly 2022.09.28
    * `nix profile install
      'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/tags/nightly-2022.09.28'`
* To install HHVM 4.169.0
    * `nix profile install
      'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/tags/HHVM-4.169.0'`
* To install the latest 4.169.* development version of HHVM
    * `nix profile install
      'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/heads/HHVM-4.169'`

Since HHVM is built with Nix for new HHVM versions only, the `ref` parameter must
point to a child commit of
[21870f6097ac7dea56ea57cc9113bcfd0d1a03d0](https://github.com/facebook/hhvm/commit/21870f6097ac7dea56ea57cc9113bcfd0d1a03d0).

The default package is the HHVM built with gcc. Alternatively you can install HHVM built with clang by prepending `#hhvm_clang` to the `git+https` URL. For example:
* To install HHVM 4.169.0 built with clang:
    * `nix profile install 'git+https://github.com/facebook/hhvm.git?submodules=1&shallow=1&ref=refs/tags/HHVM-4.169.0#hhvm_clang'`

The `hhvm_clang` package is available since the commit [7c911c6035bae429157dfa092a600dc171ffb226](https://github.com/facebook/hhvm/commit/7c911c6035bae429157dfa092a600dc171ffb226).

Also note that the binary cache for a git commit would take hours of time to be
available. If you are trying to install a recent commit, of which the binary
cache is not available yet, Nix will build it from source for you automatically,
otherwise Nix will just download the prebuilt binary.

