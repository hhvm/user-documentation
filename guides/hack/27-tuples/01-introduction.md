Tuples are a way to bundle together a fixed number of values of possibly different types.

## Syntax

The syntax for a tuple type is a parenthesis-enclosed, comma-separated list of:

 - values, when creating a tuple.
 - types, when annotating with a tuple.

```
tuple(value1, ..., value n); // for creation
(type1, ..., type n); // for annotation.
```

The types in a tuple annotation can be any type in the [type system](/hack/types/type-system), except for `void`.

The following example shows you both the creation of and annotating with a tuple

@@ introduction-examples/create-and-annotate.php @@

## Initializers

Tuples can also be used in initializer expressions for class properties.

@@ introduction-examples/initializers.php @@
