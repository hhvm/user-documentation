The binary operator `**` produces the result of raising the value of its left-hand operand to the power of the right-hand one,
both of which must have arithmetic type. If both operands have non-negative integer values and the result can be represented as
an `int`, the result has type `int`; otherwise, the result has type `float`.  For example:

```Hack
2**3;        // int with value 8
2**3.0;      // float with value 8.0
2.0**3.0;    // float with value 8.0
"2.0"**3;    // Error: no numeric strings allowed!
```
