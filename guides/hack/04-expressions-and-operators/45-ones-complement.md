The ones-complement operator, `~`, performs a bitwise complement on its `int` operand and produces an `int` result. (That
is, each bit in the result is set if and only if the corresponding bit in the operand is clear.) For example:

```Hack
$lLetter = 0x73;              // lowercase letter 's'
$uLetter = $lLetter & ~0x20;  // clear the 6th bit to make uppercase letter 'S'
```
