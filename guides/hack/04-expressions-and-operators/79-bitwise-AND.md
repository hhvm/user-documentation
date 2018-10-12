The binary operator `&` performs a bitwise-AND on its two `int` operands and produces an `int` result. For example:

```Hack
0b101111 & 0b101                        // results in 0b101
$lcase_letter = 0x73;                   // lowercase letter 's'
$ucase_letter = $lcase_letter & ~0x20;  // clear the 6th bit to make uppercase letter 'S'
```

Consider the following code fragment:

```Hack
function is_leap_year(int $yy): bool {
	return ((($yy & 3) === 0) && (($yy % 100) !== 0)) || (($yy % 400) === 0);
}
```

A year is a leap year if it is a multiple of 4 but not a multiple of 100 (for example, 1700, 1800, and 1900 were *not* leap years), or 
it's a multiple of 400. [Some redundant grouping parentheses have been added to aid readability.]

The expression `$yy & 3` is equivalent to `$yy & 0b11`. If the result is zero, this means that the low two bits of `$yy` are clear, 
making `$yy` a multiple of 4.
