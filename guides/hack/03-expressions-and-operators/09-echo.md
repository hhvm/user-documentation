This intrinsic function converts the value of an expression to `string` (if necessary) and writes the string to standard output.  For example:

```basics.hack
$v1 = true;
$v2 = 123.45;
echo '>>'.$v1.'|'.$v2."<<\n"; // outputs ">>1|123.45<<"

$v3 = "abc{$v2}xyz";
echo "$v3\n";
```

For a discussion of value substitution in strings, see [string literals](../source-code-fundamentals/literals.md#string-literals__double-quoted-string-literals).
For conversion to strings, see [type conversion](../types/type-conversion.md#converting-to-string).

`echo` cannot output an array.  However, `echo` can output the value of an object *provided* its type defines
a [`__toString` method](../classes/methods-with-predefined-semantics.md#method-__tostring).  For example:

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
  $p1 = new Point(20.5, 30.33);
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo $p1."\n"; // implicit call to __toString()
}
```
