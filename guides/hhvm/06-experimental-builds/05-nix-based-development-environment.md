This page includes instructions to set up HHVM development environment where HHVM dependencies are installed from nix.

## For Visual Studio Code Users

We provide a Visual Studio Code workspace file to develop HHVM. To set up the VS Code based HHVM development environment on any Linux machines:

1. Install nix
2. Checkout HHVM with all submodules: `git clone
   https://github.com/facebook/hhvm.git --depth 1 --recurse-submodules `
3. Open `hhvm.code-workspace` from Visual Studio Code for the gcc toolchain
   - Alternatively, open `clang.code-workspace` for the clang toolchain.
4. Install extension recommendations
5. Reload Visual Studio Code
6. Wait for the extensions to be activated. Note that it would take minutes to
   download dependencies, depending on your network speed.
7. Click the Build button from the CMake panel in Visual Studio Code

See [this instructional video](https://hhvm.com/static/videos/posts/vscode.mp4) for more detail.


### Using Development Containers Or GitHub Codespaces

Alternatively, we also provide a development container with nix pre-installed,
which can be either used in a local Docker engine or in GitHub Codespaces. See [this page](https://code.visualstudio.com/docs/remote/codespaces) and [this page](https://code.visualstudio.com/docs/remote/create-dev-container) about how to create a development container, then follow step 3 to step 7 described in the previous section for HHVM development.

See [this instructional video](https://hhvm.com/static/videos/posts/github-codespaces.mp4) for more detail.


## Working From The Command Line

To start a clean build HHVM from source:

1. Install nix.
2. Checkout HHVM with all submodules: `git clone
   https://github.com/facebook/hhvm.git --depth 1 --recurse-submodules`
3. Under the work tree, run `nix-build` or `nix build "git+file://$(pwd)?submodules=1&shallow=1"` to build HHVM with gcc.
   - Alternatively, to build HHVM with clang, run `nix build "git+file://$(pwd)?submodules=1&shallow=1#hhvm_clang"`.

To incrementally edit the source and build HHVM:

1. Install nix.
2. Checkout HHVM with all submodules: `git clone
   https://github.com/facebook/hhvm.git --depth 1 --recurse-submodules`
3. Under the work tree, run `nix-shell` or `nix develop` to
   enter a development shell with gcc. All the HHVM dependencies and development tools
   will be available in `$PATH` and other environment
   variables.
   - Alternatively, to enter the development shell with clang,
   run `nix-shell shell_clang.nix` or `nix develop "git+file://$(pwd)?submodules=1&shallow=1#clang"`
4. In the development shell, run `cmake -C "$CMAKE_INIT_CACHE" -Bbuild`
   to configure HHVM.
5. In the development shell, run `cd build && make` to build HHVM.
6. Make some changes to the source code.
7. In the development shell, run `make` to compile the affected files
   only.
