A *type alias* is a shorthand name for a type specifier or definition. Once a type alias has been defined, it can be used in nearly any context in which the associated type is permitted. The only context type aliases aren't allowed is on the right-hand side of an `instanceof`, due to technical limitations with generics.

Any given type can have multiple aliases, and a type alias can itself have aliases. Type aliases can be parameterized or [generic](/hack/generics/introduction).

The type being aliased can be anything. It could be as simple as `int`, `string`, or a class type name; or as complicated as a map-like array, a [tuple](/hack/types/type-system#tuples), or a [shape](/hack/shapes/introduction). 

In the following example:
* `Counter` is defined to be an alias for `int`.
* `Point` is defined to be an alias for a [tuple](/hack/tuples/introduction) of two `int`s.
* `Estimate` is defined to be an alias for a `Pair` of `int` and `float`.
* `StringTransformer` is defined to be an alias for a [callable](/hack/callables/introduction) that returns a [nullable](/hack/types/type-system#nullable) `string`.
* `MyCallback<T>` is defined to be an alias to a [generic](/hack/generics/introduction) [callable](/hack/callables/introduction) that returns `void`.

```
<?hh
type Counter = int;
newtype Point = (int, int);
newtype Estimate = Pair<int, float>;
newtype StringTransformer = (function(string): ?string);
newtype MyCallback<T> = (function(T): void);
```

## `newtype` and `type` Keywords

Type aliases are created using the `newtype` and `type` keywords. An alias created using `newtype` is an [*opaque type alias*](./opaque.md). An alias created using `type` is a [*transparent type alias*](./transparent.md).
