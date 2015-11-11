# Type Constants Examples

Here are some examples of where type constants may be useful when trying to decide whether to use them or [generics](../generics/introduction.md) type parameterization.

## Referencing Type Constants

Referencing type constants is as easy as referencing a static class constant.

@@ examples-examples/referencing.php @@

## Overriding Type Constants

For type constants declared in classes, it is possible provide a constraint as well as a concrete type. When a constraint is provided this allows the type constant to be overridden by child classes. This feature is not supported for interfaces.

@@ examples-examples/overriding.php.type-errors @@

## Type Constants and Instance Methods

You can use type constants as inputs to class instance methods.

@@ examples-examples/instance.php @@
