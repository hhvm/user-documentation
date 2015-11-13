## What is a Type Alias?

A *type alias* is a shorthand name for a (potentially long and complex) type specifier or definition. Once a type alias has been defined, it can be used in any context in which the associated type is permitted. Type aliasing is an abstraction mechanism. ([Shape](../shapes/introduction.md) types can *only* be used via type aliases; see below.)

Any given type can have multiple aliases, and a type alias can itself have aliases.

The type being aliased could be as simple as `int`, `string`, or a class type name; or as complicated as a map-like array, a [tuple](../types/type-system.md#tuples), or a [shape](../shapes/introduction.md). 

In the following example, `Counter` is defined to be an alias for `int`, and `Point` is defined to be an alias for a tuple of two `int`s:

```
<?hh
type Counter = int;
newtype Point = (int, int);
```

## `newtype` and `type` Keywords

Type aliases are created using the `newtype` and `type` keywords. An alias created using `newtype` is an [*opaque type alias*](./02-opaque.md). An alias created using `type` is a [*transparent type alias*](./03-transparent.md).
