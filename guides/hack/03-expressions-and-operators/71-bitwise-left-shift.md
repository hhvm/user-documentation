The binary operator `<<` works as follows: Given the expression `e1 << e2`, the bits in the value of `e1` are shifted left by `e2`
positions. Bits shifted off the left end are discarded, and zero-valued bits are shifted on from the right end. `e1` and `e2` must
both have type `int`. The type of the result is `int`, and the value of the result is that after the shifting is complete. The values
of `e1` and `e2` are unchanged.

```Hack
0b101 << 2     // result is 0b10100
```
