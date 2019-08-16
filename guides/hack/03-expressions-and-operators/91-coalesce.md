Given the expression `e1 ?? e2`, if `e1` is defined and not `null`, then the result is `e1`. Otherwise, `e2` is evaluated, and its
value becomes the result. There is a sequence point after the evaluation of `e1`.

```Hack
$nully = null;
$nully ?? 10; // 10 as $nully is `null`
$nonnull = 'a string';
$nonnull ?? 10; // 'a string' as $nonnull is `nonnull`

$arr = dict["black" => 10, "white" => null];
$arr["black"] ?? -100;  // 10 as $arr["black"] is defined and not null
$arr["white"] ?? -200;  // -200 as $arr["white"] is null
$arr["green"] ?? -300;  // -300 as $arr["blue"] is not defined
```

It is important to note that the RHS of the `??` operator will be conditionally evaluated.
If the LHS is `nonnull` (and defined, but that is a given for `nonnull` values), the RHS will not be evaluated.

```Hack
$nonnull = 4;

// The `1 / 0` will never be evaluated and no Exception is thrown.
$nonnull ?? 1 / 0;

// The function_with_sideeffect is never invoked.
$nonnull ?? function_with_sideeffect();
```

The pattern `$x = $x ?? $y` is so common that the [operator ??=](/hack/expressions-and-operators/assignment) can be used as a shorthand.