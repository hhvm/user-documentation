Given the expression `e1 ?? e2`, if `e1` is defined and not `null`, then the result is `e1`. Otherwise, `e2` is evaluated, and its
value becomes the result. There is a sequence point after the evaluation of `e1`.

```Hack
$arr = dict["black" => 10, "white" => null];
$arr["black"] ?? -100  // 10 as $arr["black"] is defined and not null
$arr["white"] ?? -200  // -200 as $arr["white"] is null
$arr["blue"] ?? -300   // -300 as $arr["blue"] is not defined
```

## `??` and `idx()`

The `??` operator is similar to the built-in function `idx()`. However, an
important difference is that `idx()` only falls back to the specified default
value if the given key does not exist, while `??` uses the fallback value even
if a key exists but has `null` value. Compare these examples to the ones above:

```Hack
$arr = dict["black" => 10, "white" => null];
idx($arr, "black", -100)  // 10
idx($arr, "white", -200)  // null
idx($arr, "blue", -300)   // -300
idx($arr, "blue")         // null
```

## Coalescing assignment operator

A coalescing
[assignment](https://docs.hhvm.com/hack/expressions-and-operators/assignment)
operator `??=` is also available. This is very useful for initializing elements
of a collection:

@@ coalesce-examples/assignment.hack @@
