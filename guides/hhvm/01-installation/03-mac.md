We currently have experimental support for HHVM installations on Mac OS X 10.12 and greater. We use an official [Homebrew](http://brew.sh/) formula.

```
brew tap hhvm/hhvm
brew install hhvm
```

This will install binary packages on recent versions of MacOS (as of 2019-03-12, this means Mojave and High Sierra). If binary packages are not available (or you pass `--build-from-source`), building will take between 20 minutes on a Mac Pro, to several hours on a MacBook Air.

Several other packages are available:

- `brew install hhvm-nightly`: installs the most recent nightly build
- `brew install hhvm@VERSION-lts` (e.g. `hhvm@3.30-lts`): installs a version with long term support

You can also [manually build from source](building-from-source#building-hhvm__macos).
