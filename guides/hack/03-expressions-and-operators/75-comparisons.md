Hack provides comparison operators. They operate on two operands and
return `bool`.

* `<`, which represents *less-than*
* `>`, which represents *greater-than*
* `<=`, which represents *less-than-or-equal-to*
* `>=`, which represents *greater-than-or-equal-to*

The type of the result is `bool`.

Comparison operators are typically used with numbers:

``` Hack
1 < 2     // true
1.0 <= 1.5 // true
```

However, comparisons also work on strings. This uses a lexicographic ordering
unless both strings are numeric, in which case the numeric values are
used:

``` Hack
"a" < "b"   // true
"ab" < "b"  // true

"01" < "1"  // false (1 == 1)
```

Arrays are compared by length, then by lexicographic ordering on
elements:

``` Hack
vec[5] < vec[1, 2]   // true (left-hand side has fewer elements)

vec[0, 2] < vec[1,2] // true (0 < 1)
```
