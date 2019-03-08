The binary operator `^` performs a bitwise exclusive-OR on its two `int` operands and produces an `int` result. For example:

```Hack
0b101111 | 0b101        // results in 0b101010
$v1 = 1234; $v2 = -987; // swap two integers having different values
$v1 = $v1 ^ $v2;
$v2 = $v1 ^ $v2;
$v1 = $v1 ^ $v2;        // $v1 is now -987, and $v2 is now 1234
```
