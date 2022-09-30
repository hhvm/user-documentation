We also provide prebuilt universal rpm packages, which do not depend on system libraries and are expected to run on Fedora, RHEL, CentOS or any other Linux distributions with `rpm` package manager.

The packages are built in GitHub Actions and uploaded as build artifacts, and can be found from the [GitHub Actions page of Nix CI](https://github.com/facebook/hhvm/actions/workflows/nix.yml). For example, [search the branch `nightly-2022.09.30`](https://github.com/facebook/hhvm/actions/workflows/nix.yml?query=branch%3Anightly-2022.09.30+event%3Apush) to find the workflow run for the nightly version 2022.09.30. Then, in [the workflow run summary page](https://github.com/facebook/hhvm/actions/runs/3155903519), you can download either `hhvm.rpm`, the HHVM package built with gcc, or `hhvm_clang.rpm`, the HHVM package built with clang, which can be then installed with the `rpm` tool:

``` bash
sudo rpm -i hhvm.rpm
```

or 

``` bash
sudo rpm -i hhvm_clang.rpm
```

## Known Issue

Similar to the universal deb packages, the universal rpm packages are also built with nix package manager and then get repacked into rpm format. As a result, the universal rpm packages will conflict with packages directly installed from the nix package manager. If you are a nix package manager user, you should directly use the [nix packages](./nix-packages.md), instead of the universal rpm packages in case of path conflicts.
