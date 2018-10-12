The binary operator `*` produces the product of its operands, which must have arithmetic type.  If either operand has type `float`, if 
necessary the other is converted to that type; the result has type `float`. Otherwise, if either operand has type `int`, if necessary the 
other is converted to that type; the result has type `int`. For example:

```Hack
-10 * 100        // int result with value -1000
100 * -3.4e10    // float result with value -3400000000000.0
-10 * "100"      // Error: no numeric strings allowed!
```
