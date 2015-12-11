In addition to the language itself, Hack provides programmers a wide set of tools for. Using [`hh_client`](../typechecker/options.md) for typechecking and inspecting your codebase is most likely to be your most used tool. However, there are other tools used to help you make the most out of Hack

* adding type annotations to your code and quick type checking ([`hh_server`](./hh_server.md))
* migrating PHP code to Hack ([`hackificator`](./hackificator.md))
* transpile Hack code to PHP ([`ht2p`](./transpiler.md))

If you installed HHVM from a package, you can generally find these tools in your `/usr/bin` or whatever binary directory executables get installed on your distro.

If you built HHVM from source, you can find the tools most likely in `hphp/hack/bin`.

By using these tools, you can more easily create new, type-safe Hack code, as well as slowly migrate any existing code to enable the benefits of Hack.
