Given the expression `e1 ?? e2`, if `e1` is defined and not `null`, then the
result is `e1`. Otherwise, `e2` is evaluated, and its value becomes the result.
There is a sequence point after the evaluation of `e1`.

@@ coalesce-examples/basics.hack @@

It is important to note that the right-hand side of the `??` operator will be
conditionally evaluated. If the left-hand side is defined and not `null`, the
right-hand side will not be evaluated.

```Hack
$nonnull = 4;

// The `1 / 0` will never be evaluated and no Exception is thrown.
$nonnull ?? 1 / 0;

// The function_with_sideeffect is never invoked.
$nonnull ?? function_with_sideeffect();
```


## `??` and `idx()`

The `??` operator is similar to the built-in function `idx()`. However, an
important difference is that `idx()` only falls back to the specified default
value if the given key does not exist, while `??` uses the fallback value even
if a key exists but has `null` value. Compare these examples to the ones above:

@@ coalesce-examples/idx.hack @@


## Coalescing assignment operator

A coalescing
[assignment](https://docs.hhvm.com/hack/expressions-and-operators/assignment)
operator `??=` is also available.

The `??=` operator can be used for conditionally writing to a variable if it is
null, or to a collection if the specified key is not present or has `null`
value.

This is similar to `e1 = e1 ?? e2`, with the important difference that `e1` is
only evaluated once.

```Hack
$arr[++$i] ??= 42;              // $i is incremented once
$arr[++$i] = $arr[++$i] ?? 42;  // $i is incremented twice
```

The `??=` operator is very useful for initializing elements of a collection:

@@ coalesce-examples/assignment.hack @@
