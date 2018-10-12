The binary operator `+` produces the sum of its operands, which must have arithmetic type. If either operand has type `float`, the 
other is converted to that type, and the result has type `float`. Otherwise, both operands have type `int`, in which case, if the 
resulting value can be represented in type `int` that is the result type. Otherwise, the type and value of [the result is 
implementation-defined](../types/int.md).

```Hack
-10 + 100       // int with value 90
100 + -3.4e2    // float with value -240
9.5 + 23.444    // float with value 32.944
-10 + "100"     // Error: no numeric strings allowed!
```
