The binary operator `-` produces the difference of its operands, which must have arithmetic type, when subtracting the right-hand
operand from the left-hand one. If either operand has type `float`, the other is converted to that type, and the result has type
`float`. Otherwise, both operands have type `int`, in which case, if the resulting value can be represented in type `int` that is
the result type. Otherwise, the type and value of [the result is implementation-defined](../built-in-types/int.md).

```Hack
-10 - 100       // int with value -110
100 - -3.4e2    // float with value 440
9.5 - 23.444    // float with value -13.944
-10 - "100"     // Error: no numeric strings allowed!
```
