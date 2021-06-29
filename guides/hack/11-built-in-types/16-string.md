The string type, `string`, is used to represent a sequence of zero or more characters. Conceptually, a string can be considered as an array of
characters -- the *elements* -- whose keys are the `int` values starting at zero. The type of each element is `string`. A string whose length is zero
is an *empty string*.

A *numeric string* is a string containing the following: optional leading whitespace, followed by an optional sign, followed by a base-10 integer
or floating-point number. A *leading-numeric string* is a string whose initial characters follow the requirements of a numeric string, and whose
trailing characters are non-numeric. A *non-numeric string* is a string that is not a numeric string. For example:

```Hack
""              // empty string
"Hello"         // string containing 5 characters
" -123"         // numeric string
'2e+5'          // numeric string
```

Consider the following example:

```__toString.hack
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
  $p1 = new Point(1.2, 3.3);
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p1 = ".$p1."\n";
}
```

Method [`__toString`](../classes/methods-with-predefined-semantics.md#method-__toString) has a return type of `string`. The return expression results in
the concatenation of the three string literals and the two `float` property values into a single string.

`'('`, `','`, `')'`, `"\$p1 = "`, and `"\n"` are examples of string literals.

Strings are usually manipulated with functions from the `Str\` namespace in the [Hack Standard Library](/hsl/reference/).
