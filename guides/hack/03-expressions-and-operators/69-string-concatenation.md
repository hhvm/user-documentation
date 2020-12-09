The binary operator `.` creates a string that is the concatenation of the left-hand operand and the right-hand operand, in that order. If
either or both operands have types other than `string`, their values are converted to type `string`. Consider the following example:

```Point.hack
class Point {
  private float $x;
  private float $y;

  public function __construct(num $x = 0, num $y = 0) {
    $this->x = (float)$x;
    $this->y = (float)$y;
  }

  public function __toString(): string {
    return '('.$this->x.','.$this->y.')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(20, 30);
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo $p1."\n"; // implicit call to __toString()
}
```

As `$p1` designates an object, the expression `$p1 . "\n"` causes the method `__toString` to be called on that object, which returns
the string `"(20,30)"`, the concatenation of the three single-quoted string literals and the two `float`s. That string in turn is
concatenated with the double-quoted string containing a newline, and the resulting string is written to standard output. Here are some
more examples, which all involve conversion to `string`:

```Hack
-10 . \NAN               // string result with value "-10NAN"
\INF . "2e+5"            // string result with value "INF2e+5"
true . null              // string result with value "1"
```
