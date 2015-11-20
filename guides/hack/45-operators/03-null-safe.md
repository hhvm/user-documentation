The null-safe operator allows you to avoid the tedious checks for object `null`-ness before calling a method or property on that object. 

The operator is:

```
?->
```

It has the same semantics as the normal `->` operator, except provides a `null`-case backout for the object in question.

Let's say you have a call like this:

```
$obj?->foo($x, $y);
```

If `$obj` is `null`, then instead of throwing a fatal error, the call site will return `null`, instead; otherwise, things work the same as if you used the normal `->` operator.

## Calling Methods

You can use the null-safe operator to call methods on a class.

@@ null-safe-examples/calling-methods.php @@

## Accessing Properties

You can use the null-safe operator to access properties.

**IMPORTANT NOTE**: The null-safe operator can only be used for **read** access to properties. Write access is forbidden

@@ null-safe-examples/accessing-properties.php @@


## Gotchas

The null-safe operator can really save time and code space, and allow for the typechecker to be able to understand possible `null` scenarios on method calls and property access, but there are some things to keep in mind.

### Function Return Types

You do have to make sure that any function in which you use this operator on a `return`-type call that your function is typed as returning a [nullable](../types/type-system.md#Nullable).

@@ null-safe-examples/function-return-types.php @@

### Undefined Methods

If the object used with the null-safe operator tries to call a method that doesn't exist, and that object is *not* `null`, you will get a fatal error at runtime. The typechecker will raise an error whether the object is `null` or not.

@@ null-safe-examples/undefined-methods.php.type-errors @@

### No Short Circuit

Even if the object is `null`, any arguments passed to the function call will still be evaluated. In other words, there is no short-circuit process that causes all evaluation to stop if the object is `null`.

@@ null-safe-examples/no-short-circuit.php @@

### Not `null` or Object

Of course, if the variable on which the null-safe operator is being used is not `null` and not an object, then that is a runtime and typechecker error.

### Not Nullable

The object on which the null-safe operator is being used itself should be nullable. This makes it so people are careful using this operator and not just throwing it around without any thought about it.

@@ null-safe-examples/not-nullable.php.type-errors @@

### No Property Writes

You cannot use the null-safe operator to try to write to properties. It is read-only.
