If a class contains a definition for a method having one of the following names, that method must have the prescribed visibility,
signature, and semantics:

Method Name	| Description
------------|-------------
[`__construct`](constructors.md) | A constructor
[`__dispose`](#method-__dispose) | Performs object-cleanup
[`__disposeAsync`](#method-__disposeasync) | Performs object-cleanup
[`__toString`](#method-__tostring) | Returns a string representation of the instance on which it is called

## Method __construct

See [Constructors](constructors.md).

## Method __dispose

This public instance method is required if the class implements the interface `IDisposable`; the method is intended to perform object
cleanup. The method's signature is, as follows:

```Hack
public function __dispose(): void;
```

This method is called implicitly by the runtime when the instance goes out of scope, provided the attributes `<<__ReturnDisposable>>`
and `<<__AcceptDisposable>>` are *not* present.

See [object disposal](object-disposal.md) for an example of its use and a discussion of these attributes.

## Method __disposeAsync

This public instance method is required if the class implements the interface `IAsyncDisposable`; the method is intended to perform
object cleanup. The method's signature is, as follows:

```Hack
public async function __disposeAsync(): Awaitable<void>;
```

This method is called implicitly by the runtime when the instance goes out of scope, provided the attributes `<<__ReturnDisposable>>`
and `<<__AcceptDisposable>>` are *not* present.

See [object disposal](object-disposal.md) for a discussion of disposal and these attributes.

## Method __toString

This public instance method is intended to create a string representation of the instance on which it is called.  For example:

```Point.php
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
  $p1 = new Point(20, 30);
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo $p1."\n"; // implicit call to __toString() returns "(20,30)"
}
```

As shown, `echo` calls `__toString` to convert the value of a `Point` to `string`.  Such implicit conversions also occur in other places
in Hack.  That said, `__toString` can be called directly.

If the instance's class is derived from a class that has or inherits a `__toString` method, the result of calling that method should be
prepended to the returned string.  For example:

```MyRangeException.php no-auto-output
class MyRangeException extends \Exception {
  public function __toString(): string {
    return parent::__toString().">>MyRangeException stuff<<";
  }
  // ...
}
```

As base class `Exception` has a `__toString` method, we should preserve the work it does.
