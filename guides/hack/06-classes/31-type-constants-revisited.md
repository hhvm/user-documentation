Imagine that you have a class, and some various `extends` to that class.

@@ type-constants-revisited-examples/non-parameterized.php @@

Now imagine that you realize that sometimes the ID of a user could be a `string` as well as an `int`. But you know that the concrete classes
of `User` will know exactly what type will be returned.

While this situation could be handled by using generics, an alternate approach is to use type constants. Instead of types being declared
as parameters directly on the class itself, type constants allow the type to be declared as class member constants instead.

@@ type-constants-revisited-examples/type-constants.php @@

Notice the syntax `abstract const type <name> [ as <constraint> ];`. All type constants are `const` and use the keyword `type`. You
specify a name for the constant, along with any possible [constraints](/hack/generics/type-constraints) that
must be adhered to.

## Using Type Constants

Given that the type constant is a first-class constant of the class, you can reference it using `this`. As
a type annotation, you annotate a type constant like:

```
this::<name>
```

e.g.,

```
this::T
```

You can think of `this::` in a similar manner as the [`this` return type](../built-in-types/this.md).

This example shows the real benefit of type constants. The property is defined in `Base`, but can have different types depending
on the context of where it is being used.

@@ type-constants-revisited-examples/annotation.php @@

## Examples

Here are some examples of where type constants may be useful:

### Referencing Type Constants

Referencing type constants is as easy as referencing a static class constant.

@@ type-constants-revisited-examples/referencing.php @@

### Overriding Type Constants

For type constants declared in classes, it is possible to provide a constraint as well as a concrete type. When a constraint is provided this allows
the type constant to be overridden by child classes. This feature is *not* supported for interfaces.

@@ type-constants-revisited-examples/overriding.php @@

### Type Constants and Instance Methods

You can use type constants as inputs to class instance methods.

@@ type-constants-revisited-examples/instance.php @@
