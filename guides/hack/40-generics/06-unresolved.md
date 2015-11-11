# Unresolved Types

Imagine the following usage of a generic `Box` class

@@ unresolved-examples/unresolved.php.type-errors @@

We create a new `Box`. Store an `int`. Then store a `string`. 

Intuitively, you would think that the the typechecker should raise an error. But it doesn't!

At the point where we store `string` in `unresolved()`, we have an *unresolved type* (see discussion on non-generic unresolved types [here](../types/inference.md#unresolved-types)). This means that our `Box` could be a `Box<int>` or a `Box<string>`. We just don't know yet. And since we never hit a boundary relating to the usage of `Box` in `unresolved()`, the typechecker just moves on.

The typechecker generally works on the boundaries. It checks against method calls to methods with [annotated](../types/annotations.md) parameters. It checks when we `return` from a function against the type annotation of the return type. And so on.

When we store the `string` in `resolved()`, we are not yet at the boundary condition. It is only when we call a function expecting a `Box<int>` where the type error would be thrown.
