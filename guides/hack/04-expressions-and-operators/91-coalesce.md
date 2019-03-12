Given the expression `e1 ?? e2`, if `e1` is defined and not `null`, then the result is `e1`. Otherwise, `e2` is evaluated, and its
value becomes the result. There is a sequence point after the evaluation of `e1`.

```Hack
$arr = dict["black" => 10, "white" => null];
$arr["black"] ?? -100  // 10 as $arr["black"] is defined and not null
$arr["white"] ?? -200  // -200 as $arr["white"] is null
$arr["blue"] ?? -300   // -300 as $arr["blue"] is not defined
```
