The binary relational operators are, as follows:
* `<`, which represents *less-than*
* `>`, which represents *greater-than*
* `<=`, which represents *less-than-or-equal-to*
* `>=`, which represents *greater-than-or-equal-to*

The type of the result is `bool`.

```Hack
"" < "ab"       // result has value true
"a" > "A"       // result has value true
"a0" < "ab"     // result has value true
"aA <= "abc"    // result has value true
// -----------------------------------------
10 <= 0         // result has value false
'123' <= '4'    // false; is doing a numeric comparison
'X123' <= 'X4'  // true; is doing a string comparison
// -----------------------------------------
vec[100] < vec[10,20,30] // result has value true (LHS array is shorter)
```
