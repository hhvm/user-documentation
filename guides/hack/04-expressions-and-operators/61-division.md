The binary operator `/` produces the quotient from dividing the left-hand operand by the right-hand one, both of which must have 
arithmetic type. If either operand has type `float`, if necessary the other is converted to that type; the result has type `float`. Otherwise, 
if either operand has type `int`, if necessary the other is converted to that type; the result has type `int` unless the mathematical value of 
the computation *cannot* be represented using type `int`, in which case, the type of the result is `float`. The right-hand operand *must not* be zero.

```Hack
300 / 100       // int result with value 3
100 / 123       // float result with value 0.8130081300813
12.34 / 2.3     // float result with value 5.3652173913043
"300" / 100     // Error: no numeric strings allowed!
```
