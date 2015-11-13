# HHVM Inconsistencies with PHP Engine

For the most part, HHVM is quite compatible with the PHP engine. In other words, PHP code that runs on the PHP engine will run unmodified with the exact output on HHVM.

However, there are some noted inconsistencies. They are listed here.

*Note*: This list may not be exhaustive; feel free to submit a [pull request](https://github.com/facebook/hhvm/pulls) or [file an issue](https://github.com/facebook/hhvm/issues) on any other inconsistencies you may find.

## Arrays

## Array internal cursors

Under PHP5, if an array's internal cursor points to the position past the last element and then a copy of the array is made, the copy will have its internal cursor reset to point at the first element. Under HHVM, when a copy of an array is made, the copy's internal cursor will always point to the same position that the original array's internal cursor pointed to.

@@ introduction-examples/array-internal-cursors.php @@

Difference: [https://3v4l.org/QOOGA](https://3v4l.org/QOOGA)

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

@@ introduction-examples/toString-exception.php @@

Difference: [https://3v4l.org/XHDP8](https://3v4l.org/XHDP8)

### `__call`/`__callStatic()` handling

Take the following example:

@@ introduction-examples/call.php @@

Under HHVM, both checking and invocation of `__call()` happen on class G. In PHP, you will get a fatal error. 

Difference: [https://3v4l.org/t9pba](https://3v4l.org/t9pba)

### Object internal cursors

Under PHP5, objects have an internal cursor (similar to the array internal cursor) that can be used to iterate over the object's properties. Under HHVM, objects do not have internal cursors, and the `next()`, `prev()`, `current()`, `key()`, `reset()`, `end()`, and `each()` builtin functions do not support objects.

### Suppressing errors for parameters to default constructors

If a class doesn't define a constructor then you construct that object passing whatever you want, including things that would fatal the runtime. HHVM doesn't allow this, and will always evaluate the arguments whether the class has a constructor or not.

@@ introduction-examples/default-constructor-param.php @@

Difference: [https://3v4l.org/FDpj0](https://3v4l.org/FDpj0)

## Misc

### Case-insensitive constants

HHVM does not support case-insensitive constants, for example:

@@ introduction-examples/case-insensitive-constants.php @@

Difference: [https://3v4l.org/nCBh1](https://3v4l.org/nCBh1)

### `get_defined_vars()` and `get_declared_classes()`

HHVM may return variables/classes in a different order than PHP5.

Under different builds of HHVM, they will be consistent though.

### `preg_replace /e`.

HHVM and PHP 5.5+ has deprecated support for `preg_replace()` with the `/e` modifier. PHP 7 removes support of it completely. Use `preg_replace_callback()` instead.

### Converting $GLOBALS to bool 

Converting `$GLOBALS` to `bool` will always evaluate to `true`, even if `$GLOBALS` is empty. Converting to `bool` can mean an explicit cast, or an implicit conversion inside the condition of an if statement or similar.

### Fatals and continued execution

All fatals prevent further PHP code from executing, including `__destruct` methods. 

**Note**: `exit()` is a fatal.

### External Entities in LibXML

Loading of external entities in the libxml extension is disabled by default for security reasons. It can be re-enabled on a per-protocol basis (`file`, `http`, `compress.zlib`, etc...) with a comma-separated list in the ini setting
`hhvm.libxml.ext_entity_whitelist`.

### Local Variables containing a parameter

If the value of a local variable containing a parameter changes, `func_get_args()` returns the new value. This behavior matches PHP7, but not PHP5 (in PHP5, the original parameter value is used). 

Differences: [https://3v4l.org/OgFts](https://3v4l.org/OgFts)

@@ introduction-examples/local-var-param.php @@

### PharData

Under HHVM, `PharData` will extract symlinks from tar files. PHP5 will create empty files instead.

### XDebug

XDebug defaults to using the time for naming the output file. PHP5 uses the PID instead.
