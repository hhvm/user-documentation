The binary operator `>>` works as follows: Given the expression `e1 >> e2`, the bits in the value of `e1` are shifted right by `e2`
positions. Bits shifted off the right end are discarded, and the sign bit is propagated from the left end. `e1` and `e2` must both
have type `int`. The type of the result is `int`, and the value of the result is that after the shifting is complete. The values of `e1`
and `e2` are unchanged.

Consider the following:

```Hack
(1 << 63) >> 63
```

If an `int` is 64 bits, what is the result? At a glance, it might seem like it should be 1. However, it is -1! When 1 is shifted
left 63 bits, it becomes -9223372036854775808 (0x8000000000000000). Specifically, the sign bit gets set. Then when that value is
right-shifted 63 bits, the sign bit is extended, keeping the value negative.
