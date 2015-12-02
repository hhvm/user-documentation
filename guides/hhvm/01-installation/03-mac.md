We currently have experimental support for HHVM installations on Mac OS X 10.10 and greater. We use an official [Homebrew](http://brew.sh/) formula. 

While you can [build from source](/hhvm/installation/building-from-source), it is generally advisable for ease of installation and stability to use a the following Homebrew formula.

## Homebrew Formula

This is an officially-maintained formula, and the easiest and recommended way to install HHVM on a Mac.

```
brew tap hhvm/hhvm
brew install hhvm
```

And then wait a long time for it to compile since [we don't provide bottles yet](https://github.com/hhvm/homebrew-hhvm/issues/5). (This will be anywhere from twenty minutes on a beefy Mac Pro to a couple of hours on a MacBook Air.)
