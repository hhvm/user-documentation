We currently have experimental support for HHVM installations on Mac OS X 10.10 and greater. We use an official [Homebrew](http://brew.sh/) formula. While you can [build from source](/hhvm/installation/building-from-source), it is generally advisable for ease of installation and stability to use the formula.  If you experience issues, consider trying to run HHVM using Docker (see the [Docker install instructions](/hhvm/installation/docker)).

```
brew tap hhvm/hhvm
brew install hhvm
```

And then wait a long time for it to compile since [we don't provide bottles yet](https://github.com/hhvm/homebrew-hhvm/issues/5). (This will be anywhere from twenty minutes on a beefy Mac Pro to a couple of hours on a MacBook Air.)
