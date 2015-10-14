# HHVM Inconsistencies with PHP Engine

For the most part, HHVM is quite compatible with the PHP engine. In other words, PHP code that runs on the PHP engine will run unmodified with the exact output on HHVM.

However, there are some noted inconsistencies. They are listed here.

*Note*: This list may not be exhaustive; feel free to submit a pull request or issue on any other inconsistencies you may find.


## Arrays

## Next free integer key for arrays

Arrays contain a hidden field called the `NextFreeElement` field that tracks what integer key should be used when a new element is appended. Under PHP5, when an array is copied the `NextFreeElement` field of the new array will be recomputed based on the keys it currently contains. Under HHVM, when an array is copied the new array's `NextFreeElement` field is set to the same value as the original array's `NextFreeElement` field.

## Array internal cursors

Under PHP5, if an array's internal cursor points to the position past the last element and then a copy of the array is made, the copy will have its internal cursor reset to point at the first element. Under HHVM, when a copy of an array is made, the copy's internal cursor will always point to the same position that the original array's internal cursor pointed to.

## Foreach 

### Foreach by value

Under PHP5, `foreach` by value will modify the array's internal cursor under certain circumstances. Under HHVM, `foreach` by value will never modify the array's internal cursor.

### Foreach by reference

Under PHP5, the behavior of a `foreach` by reference loop can be unpredictable if during iteration the next element of the array is unset, or if the array variable is assigned to directly or through a reference, or if copy-on-write causes the array to be copied. For such cases, HHVM's behavior may differ from PHP5.


## Classes and objects

### Exceptions thrown from destructors

Under HHVM, PHP exceptions thrown from destructors will be swallowed while logging an error. Effectively, there is a `try/catch` enclosing the body of the `__destruct` method. These exceptions are catchable under the PHP engine outside of the `__destruct` method.

Fatals thrown from destructors will log an error, and prevent further PHP code from executing as the fatal propagates. This includes other `__destruct` methods.

### Exceptions thrown from `__toString()`

PHP5 does not allow exceptions to be thrown from `__toString()`. HHVM does.

### `__call`/`__callStatic()` handling

This example gives inconsistent results in PHP5:

```
  <?php
  class B {
  }
  class G extends B {
    function __call($name, $arguments) { var_dump('G');}
    function f4missing($a) {
      B::f4missing(5); // __call checking happened at B
    }
  }
  $g = new G();
  $g->f4missing(3);
```

Under HHVM, both checking and invocation of `__call()` happen on class G.

### Object internal cursors

Under PHP5, objects have an internal cursor (similar to the array internal cursor) that can be used to iterate over the object's properties. Under HHVM, objects do not have internal cursors, and the `next()`, `prev()`, `current()`, `key()`, `reset()`, `end()`, and `each()`` builtin functions do not support objects.

### Suppressing errors for params to default constructors

If a class doesn't define a constructor then you construct that object passing whatever you want, including things that would fatal the runtime. HHVM doesn't allow this, and will always evaluate the args whether the class has a constructor or not.

```
  <?php
  class A {}
  var_dump(new A(undefined_function())); // Works in PHP5 but not HHVM

  class B {
    public function __construct() {
    }
  }
  var_dump(new B(undefined_function())); // Doesn't work in neither HHVM nor PHP5
```

## Misc

### Case-insensitive constants

HHVM does not support case-insensitive constants, for example:
```
  define('FOO', 123, true);
```

### `get_defined_vars()` and `get_declared_classes()`

HHVM may return variables/classes in a different order than PHP5.

Under different builds of HHVM, they will be consistent though.

### HHVM only supports `preg_replace /e` in limited cases.

### Under PHP5, you can assign to `$GLOBALS`:

```
  $GLOBALS = 0;
  $x = $GLOBALS - 5;

  $g = $GLOBALS;
  $g['x'] = 3;
```

Under HHVM, this is not allowed or not working at present.

### Converting $GLOBALS to bool 

Converting `$GLOBALS` to `bool` will always evaluate to `true`, even if `$GLOBALS` is empty. Converting to `bool` can mean an explicit cast, or an implicit conversion inside the condition of an if statement or similar.

### Fatals and continued execution

All fatals prevent further PHP code from executing, including `__destruct` methods. 

**Note**: `exit()` is a fatal.

### External Entities in LibXML

Loading of external entities in the libxml extension is disabled by default for security reasons. It can be re-enabled on a per-protocol basis (`file`, `http`, `compress.zlib`, etc...) with a comma-separated list in the ini setting
`hhvm.libxml.ext_entity_whitelist`.

### Local Variables containing a parameter

If the value of a local variable containing a parameter changes, `func_get_args()`` returns the new value. This behavior matches PHP7, but not PHP5.

```
  class Foo {
    function bar($baz) {
      $baz = 'herpderp';
      // Always outputs array('herpderp')
      var_dump(func_get_args());
    }
  }
```

### PharData

Under HHVM, `PharData` will extract symlinks from tar files. PHP5 will create empty files instead.

(10) XDebug defaults to using the time for naming the output file. PHP5 uses the
PID instead.
