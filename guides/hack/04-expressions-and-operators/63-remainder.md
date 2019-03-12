The binary operator `%` produces the `int` remainder from dividing the left-hand `int` operand by the right-hand `int` operand, which *must not*
be zero. Consider the following:

```Hack
function is_leap_year(int $yy): bool {
	return ((($yy & 3) === 0) && (($yy % 100) !== 0)) || (($yy % 400) === 0);
}
```

A year is a leap year if it is a multiple of 4 but not a multiple of 100 (for example, 1700, 1800, and 1900 were *not* leap years), or it's
a multiple of 400. [Some redundant grouping parentheses have been added to aid readability.]

The expression `(($yy % 100) !== 0)` determines whether `$yy` is not a multiple of 100, while `(($yy % 400) === 0)` determines whether `$yy`
is a multiple of 400.
