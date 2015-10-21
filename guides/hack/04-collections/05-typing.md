# Typing Collections

You will generally instantiate Hack collection objects through the [concrete classes](./classes.md). However, what parameter type is accepted by or returned from a method could indeed be one of the [interfaces](./interfaces.md).

The following example shows how you can pass any of the concrete classes to a function that takes an `Iterable<T>`. In these cases `T` is representing the types of the values of each collection. So `int` for `$v` and `string` for `$m`. For the maps, the types of the keys don't matter in this case.

@@ typing-examples/iterable.php

The following example shows how you can use `ConstVector` to ensure that you are passing a vector that cannot be modified. You might ask why not annotate it with `ImmVector`? That's because you can imagine other immutable vectors being implemented in the future; and since all immutable vectors must implement `ConstVector`, it is more expressive to use `ConstVector` instead. The same rationale is applied to the return type `MutableVector`.

Now, if you know the function will only take an `ImmVector` for now and always, then type annotating it as `ImmVector` would be fine.

@@ typing-examples/constvector.php.type-errors @@ 
