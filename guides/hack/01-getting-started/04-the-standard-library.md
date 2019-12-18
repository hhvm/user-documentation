## The Hack Standard Library (HSL)

The Hack Standard Library is rapidly evolving, and currently distributed
separately to HHVM; there are two GitHub projects/composer packages:

- [hhvm/hsl](https://github.com/hhvm/hsl/): The Hack Standard Library
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
