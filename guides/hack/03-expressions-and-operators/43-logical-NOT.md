The logical NOT operator, `!`, requires an operand of Boolean or arithmetic type. The type of the result is `bool`.  If the value of the
operand is `false` or non-zero, the value of the result is `true`; otherwise, the value of the result is `false`. Given the following:

```Hack
function is_leap_year(int $yy): bool { ... }
if (!is_leap_year(1957)) ...
```

the `if` statement is equivalent to:

```Hack
if (is_leap_year(1957) !== true) ...
```

If `$v` has an arithmetic type, `!$v` is equivalent to `$v === 0` or `$v === 0.0`, as appropriate.
