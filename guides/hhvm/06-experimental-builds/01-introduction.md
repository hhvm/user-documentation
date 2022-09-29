The following pages of documentation describe the universal build environments and installation methods, aiming to build and run HHVM on any Linux distribution, including:

* [Prebuilt nix packages](./prebuilt-nix-packages.md) are HHVM binaries that can be installed from nix package manager on any Linux distribution.
* [Universal deb packages](./universal-deb-packages.md) are deb packages, repacked from the nix packages, which can be installed on any Linux distribution with `apt` and `dpkg` tools.
* [Universal rpm packages](./universal-rpm-packages.md) are rpm packages, repacked from the nix packages, which can be installed on any Linux distribution with a `rpm` tool.
* [Nix based development environment](./prebuilt-nix-packages.md) includes instructions to set up command-line shell environments, Visual Studio Code workspaces, and GitHub Codespaces for developing HHVM with dependencies from nix package manager.

## About The Experiments

Currently, the above packages are experimental. They are provided as is and haven’t been extensively battle-tested. We encourage you to try them out and report any issues you encountered. We will appreciate your feedback because it will help us decide if we will entirely switch from distribution-specific packaging to universal packaging.
