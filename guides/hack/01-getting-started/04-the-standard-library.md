## The Hack Standard Library (HSL)

**Note:** Before HHVM 4.108, the Hack Standard Library was distributed
[separately from HHVM](https://github.com/hhvm/hsl/).

As of 4.108, HHVM is distributed with a growing set of functions and classes
collectively called the [Hack Standard Library (HSL)](/hsl/reference/).
These are intended to complement, or in some cases replace previous
[built-in APIs](/hack/reference/).

There are two related GitHub projects/Composer packages:

- [hhvm/hsl](https://github.com/hhvm/hsl/): The Hack Standard Library for users
  of HHVM < 4.108
- [hhvm/hsl-experimental](https://github.com/hhvm/hsl-experimental/):
  Experimental features, which may be added to the Hack Standard Library in the
  future

Design goals include:
- fits well with Hack's type system and overall design
- internal consistency and predicatability
- provide building blocks for clear composition instead of many high-level
  functions

HSL features are grouped by namespace; the namespace indicates the problem area,
or - if more fine-grained separation is needed - by return type. For example:

- `HH\Lib\Str` contains functions for interacting with strings, such as
  `Str\contains()`
- `HH\Lib\Dict` contains functions that return `dict`s, such as `Dict\map()`
- `HH\Lib\Vec` contains functions that return `vec`s, such as `Vec\map()`
- `HH\Lib\C` contains functions that operate on `C`ontainers, but do not
  return or require a specific kind of container, such as `C\contains()`

For a full list, see [the API reference](/hsl/reference/); there is also
a table containing common functions for [container manipulation].

[container manipulation]: /hack/built-in-types/arrays#using-dicts-keysets-and-vecs
