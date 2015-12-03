There are two ways to get the typechecker: automatically when you install HHVM or by compiling it.

## Installed with HHVM

The Hack typechecker is installed automatically when you [install HHVM](../../hhvm/installation/introduction.md) via one of our official packages. The typechecker client is generally installed at `/usr/bin/hh_client` while the typechecker server is generally installed at `/usr/bin/hh_server`.

## Building from Source

The Hack typechecker source code is part of the [HHVM source code](https://github.com/facebook/hhvm/tree/master/hphp/hack). If you follow [the documentation for building HHVM from source](/hhvm/installation/building-from-source), the typechecker will be built too.

The built-from-source version of the typechecker will be located at `<HHVM source root>/hphp/hack/bin/hh_client` and `<HHVM source root>/hphp/hack/bin/hh_server`.

If for some reason you need to build *just* the typechecker, and not all of HHVM, instead of running `make` to build everything, you can run `make hack` to just build the typechecker. This isn't recommended, since you'll need HHVM anyways in order to actually run any code!

## Windows Support

The typechecker has a port in progress for Windows. When it's complete, it might make local development on Windows slightly less annoying until [HHVM's Windows port](/hhvm/installation/windows) is fully complete, since you will be able to typecheck Hack code locally, outside of the Linux VM HHVM must run in.
