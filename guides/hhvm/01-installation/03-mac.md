We currently have experimental support for HHVM installations on Mac OS X 10.12 and greater. We use an official [Homebrew](http://brew.sh/) formula.

```
brew tap hhvm/hhvm
brew install hhvm
```

This will install binary packages on recent versions of MacOS (as of 2017-11-08, this means Sierra and High Sierra). If binary packages are not available (or you pass `--build-from-source`), building will take between 20 minutes on a Mac Pro, to several hours on a MacBook Air.

We also sporadically make "preview" releases, also with binary packages. You can install them with:

```
brew unlink hhvm # if you have HHVM installed
brew tap hhvm/hhvm
brew install hhvm-preview
```

We hope to replace `hhvm-preview` with nightly builds in the future.

You can also [manually build from source](building-from-source#building-hhvm__macos).
