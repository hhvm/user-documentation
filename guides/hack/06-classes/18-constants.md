A class may contain definitions for named constants, which have public visibility.  A class constant belongs to the class
as a whole, so it is implicitly `static`.  For example:

```auto-color.php
class Automobile {
  const DEFAULT_COLOR = "white";
  // ...
}

<<__EntryPoint>>
function main(): void {
  $col = Automobile::DEFAULT_COLOR;
  echo "\$col = $col\n";
}
```

If a class constant's type is omitted, it is inferred from the initializer, which must be present. In this case, that type is `string`.

As we can see, outside its parent class, a class constant's name must be qualified by the
[scope-resolution operator, `::`](../expressions-and-operators/scope-resolution.md); after all, multiple classes might define
constants by the same (unrelated) name.

Note that for some types&mdash;the legacy container types `Vector`, `Map`, `Set`, et al., and closures&mdash;there is *no* way to write an initializer that
is considered to be a compile-time constant. Therefore, a class constant cannot have such a type. However, the types `array`, `vec`, `dict`, and
`set`, can be used *provided* all their subinitializers are constant expressions.
