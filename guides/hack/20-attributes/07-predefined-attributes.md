The following attributes are defined:
* [__AcceptDisposable](#__acceptdisposable)
* [__ConsistentConstruct](#__consistentconstruct)
* [__Deprecated](#__deprecated)
* [__EntryPoint](#__entrypoint)
* [__LateInit](#__lateinit)
* [__Memoize](#__memoize)
* [__MemoizeLSB](#__memoizelsb)
* [__MockClass](#__mockclass)
* [__Override](#__override)
* [__ReturnDisposable](#__returndisposable)
* [__Sealed](#__sealed)

## __AcceptDisposable

This attribute can be applied to a function parameter that has a type that implements interface `IDisposable` or `IAsyncDisposable`.

See [object disposal](../classes/object-disposal.md) for an example of its use.

## __ConsistentConstruct

When a method is overridden in a derived class, it must have exactly the same number, type, and order of parameters as that in the base
class. However, that is not usually the case for constructors. Having a family of constructors with different signatures can cause a problem,
however, especially when using `new static`.

This attribute can be applied to classes; it has no attribute values.  Consider the following example:

```Hack
<<__ConsistentConstruct>>
class Base {
  public function __construct() { ... }

  public static function make(): this {
    return new static();
  }
}

class Derived extends Base {
  public function __construct() {
    ...
    parent::__construct();
  }
}

$v2 = Derived::make();
```

When `make` is called on a `Derived` object, `new static` results in `Derived`'s constructor being called knowing only the parameter list
of `Base`'s constructor. As such, `Derived`'s constructor must either have the exact same signature as `Base`'s constructor, or the same
plus an ellipsis indicating a trailing variable-argument list.

## __Deprecated

This attribute can be applied to a function to indicate that it has been *deprecated*; that is, it is obsolete, and calls to it should be
revised. This attribute has two possible attribute values.  Consider the following example:

```Hack
<<__Deprecated("This function has been replaced by do_that", 7)>>
function do_this(): void { /* ... */ }

```

The presence of this attribute on a function has no effect, unless that function is actually called, in which case, for each call to that
function, the type checker issues a diagnostic containing the text from the first attribute value.  The optional `int`-typed second attribute
value (in this case, 7) indicates a *sample rate*. Assuming the program will still execute, every 1/sample-rate calls (as in, 1/7) to that
function will be diagnosed at runtime.

## __EntryPoint

A Hack program begins execution at a top-level function referred to as the *entry-point function*. A top-level function can be designated as such using this attribute, which
has no attribute values. For example:

```Hack
<<__EntryPoint>>
function main(): void {
  \printf("Hello, World!\n");
}
```

Note: An entry-point function will *not* be automatically executed if the file containing such a function is included via require or the autoloader.

## __LateInit

This attribute marks a property as being initialized via a non-standard mechanism, i.e., not via standard assignment in the
constructor. It has no attribute values. Attempting to read the value of an uninitialized <<__LateInit>> properties is a runtime error.

## __Memoize

The presence of this attribute causes the designated method to automatically cache each value it looks up and returns, so future calls with
that same parameters can be retrieved more efficiently. The set of parameters is hashed into a single hash key, so changing the type, number,
and/or order of the parameters can change that key.

This attribute can be applied to functions and static or instance methods; it has no attribute values.  Consider the following example:

```Hack
class Item {
  <<__Memoize>>
  public static function get_name_from_product_code(int $productCode): string {
    if (name-in-cache) {
      return name-from-cache
    } else {
      return Item::get_name_from_storage($productCode);
    }
  }
  private static function get_name_from_storage(int $productCode): string {
    // get name from alternate store
    return ...;
  }
}
```

`Item::get_name_from_storage` will only be called if the given product code is not in the cache.

The types of the parameters are restricted to the following: `null`, `bool`, `int`, `float`, `string`, any object type that implements
`IMemoizeParam`, enum constants, tuples, shapes, and arrays/collections containing any supported element type.

The interface type `IMemoizeParam` assists with memorizing objects passed to async functions.

### Limitations

- If an exception is thrown, this is not memoized.
- Functions with variadic parameters can not be memoized

## __MemoizeLSB

This is like [<<__Memoize>>](#__memoize), but the cache has Late Static Binding. Each subclass has its own memoize cache.

## __MockClass

Mock classes are useful in testing frameworks when you want to test functionality provided by a legitimate, user-accessible class,
by creating a new class (many times a child class) to help with the testing. However, what if a class is marked as `final` or a method in a
class is marked as `final`? Your mocking framework would generally be out of luck.

The `__MockClass` attribute allows you to override the restriction of `final` on a class or method within a class, so that a
mock class can exist.

@@ predefined-attributes/mock.php @@

Mock classes *cannot* extend types `vec`, `dict`, and `keyset`, or the Hack legacy types `Vector`, `Map`, and `Set`.

## __Override

The presence of this attribute indicates that the designated method is intended to override a method having the same name in a direct
or indirect base class. If no such base-class method exists, a compile-time error occurs.

This attribute can be applied to static or instance methods; it has no attribute values.  Consider the following example:

```Hack
class Button {
  public function draw(): void { /* ... */ }
}
class CustomButton extends Button {
  <<__Override>>
  public function draw(): void { /* ... */ }
}
```

If a subsequent refactoring of class `Button` results in the removal of method `draw`, the presence of the attribute in class `CustomButton`
will cause the dependence to be reported.

When `__Override` is applied to a method in a trait, the check for whether the overridden method exists takes place when a class uses that trait.

## __ReturnDisposable

This attribute can be applied to a function that returns a value whose type implements interface `IDisposable` or `IAsyncDisposable`.

See [object disposal](../classes/object-disposal.md) for an example of its use.

## __Sealed

A class that is *sealed* can be extended directly only by the classes named in the attribute value list. Similarly, an interface that is sealed
can be implemented directly only by the classes named in the attribute value list. Classes named in the attribute value list can themselves be
extended arbitrarily unless they are final or also sealed. In this way, sealing provides a single-level restraint on inheritance.
For example:

```Hack
<<__Sealed(X::class, Y::class)>>
abstract class A { ... }

<<__Sealed(Z::class)>>
interface I { ... }
```

Only classes `X` and `Y` can directly extend class `A`, and only class `Z` can directly implement interface `I`.
