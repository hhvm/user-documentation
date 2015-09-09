There are two ways to get the typechecker: automatically when you install HHVM or by compiling it.

## Installed with HHVM

The Hack typechecker is installed automatically when you [install HHVM](../../hhvm/installation/intro.md). The typechecker client is generally installed at `/usr/bin/hh_client` while the typechecker server is generally installed at `/usr/bin/hh_server`.

## Building from Source

The Hack typechecker source code is part of the [HHVM source code](https://github.com/facebook/hhvm/tree/master/hphp/hack). If you are building HHVM from source via `cmake`, and you want the typechecker to be included in your build, then there you have to make sure you have the following prerequisites to build the typechecker:

- OCaml 3.12 or greater

OCaml may already be installed on your system if you followed the instructions for building HHVM for your distribution (e.g. [Linux](../../hhvm/installation/linux/intro.md)).

The built-from-source version of the typechecker will be located at `<HHVM source root>/hphp/hack/bin/hh_client` and `<HHVM source root>/hphp/hack/bin/hh_server`.

### Building Hack separately from HHVM

If you built HHVM, then the typechecker will automatically be part of the build. If you want to build the typechecker separately, then you can. Just:

```
make hack
```

## Windows Support

It is coming..

There is a concerted effort to get both HHVM and the typechecker running on Windows. In fact, there has been successful builds of both already.
