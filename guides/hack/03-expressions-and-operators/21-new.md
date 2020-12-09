The `new` operator allocates memory for an object that is an instance of the specified class.  The object is initialized by calling the
class's [constructor](../classes/constructors.md) passing it the optional argument list, just like a function call. If the class has no
constructor, the constructor that class inherits (if any) is used.  For example:

```Point.hack
class Point {
  private static int $pointCount = 0; // static property with initializer
  private float $x; // instance property
  private float $y; // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x; // access instance property
    $this->y = (float)$y; // access instance property
    ++Point::$pointCount; // include new Point in Point count
  }

  public function __toString(): string { // instance method
    return '('.$this->x.','.$this->y.')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(); // create Point(0.0, 0.0)
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p1 is $p1\n";

  $p2 = new Point(12.3); // create Point(12.3, 0.0)
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p2 is $p2\n";

  $p3 = new Point(5, 6.7); // create Point(5.0, 6.7)
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p3 is $p3\n";
}
```

The result is an object of the type specified.

The `new` operator may also be used to allocate memory for an instance of a [classname](../built-in-types/classname.md) type; for example:

```Hack
final class C { ... }
function f(classname<C> $clsname): void {
  $w = new $clsname();
  ...
}
```

Any one of the keywords `parent`, `self`, and `static` can be used between the `new` and the constructor call, as follows. From within a
method, the use of `static` corresponds to the class in the inheritance context in which the method is called. The type of the object
created by an expression of the form `new static` is
[`this`](../built-in-types/this.md). See [scope resolution](scope-resolution.md) for a discussion of `parent`,
`self`, and `static` in this context.
