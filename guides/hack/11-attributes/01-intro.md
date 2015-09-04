Attributes are essentially a holder of metadata for any [reflectable](link to reflection) piece of code. This includes functions, classes, interfaces, traits, etc. 

Unless they are [special](04-special.md), attributes are a syntactic entity. They lend themselves to tooling to accomplish tasks. For example, you can have documentation-based attributes, the contents of which are extracted by reflection.

@@ 01-intro-examples/simple.php @@

## Special Attributes

Some attributes have special meaning to both the Hack typechecker and HHVM. 

- [`__Override`](04-special.md#__Override)
- [`__ConsistentConstruct`](04-special.md#__ConsistentConstruct)
- [`__Memoize`](04-special.md#__Memoize)
- [`__Deprecated`](04-special.md#__Deprecated)

There are a few [other special attributes](04-special.md#Other) as well.
