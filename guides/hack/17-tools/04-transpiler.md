# The Hack Transpiler

The Hack transpiler, `h2tp`, allows you to write code in Hack and then off your code to folks who only deploy on an engine that doesn't support Hack, but rather supports only PHP. This gives you the benefits of writing your code in Hack, allowing users who run code on an Hack supported runtime like HHVM to use Hack code, while also allowing users who haven't made the switch to something like HHVM to use your code as well.

```
h2tp <source directory of Hack code> <destination directory of transpiled code>
```

The source and destination must be directories. And the destination directory *must not* exist.

## Hack Library

Imagine we have this Hack file in `/tmp/original`:

```
<?hh

class A {
  protected ?int $x = null;

  public function foo(): bool {
    return true;
  }
}

function bar(Vector<int> $vec): int {
  if ($vec->count() > 0) {
    return $vec[0];
  }
  return -1;
}
```

We run the Hack transpiler as such:

```
h2tp /tmp/original /tmp/transpiled
```

If you examine the transpiled file in `/tmp/transpiled`:

```
<?php
require_once ($GLOBALS["HACKLIB_ROOT"]);
class A {
  protected $x = null;
  public function foo() {
    return true;
  }
}
function bar($vec) {
  if ($vec->count() > 0) {
    return $vec[0];
  }
  return -1;
}
```

Notice the following:

* There are no more type annotations.
* We have a new line `require_once ($GLOBALS["HACKLIB_ROOT"]);`

The new `require_once` line is **important**. After you use the transpiler, you must copy the Hack library to the transpiled directory. The Hack library is called `hacklib` and is normally located in `/usr/share/hhvm/hack/hacklib`.

```
cp -r /usr/share/hhvm/hack/hacklib /tmp/traspiled
```

Finally, add a piece of code to a top-level file somewhere in the root of your transpiled directory that will run before any of the transpiled code will run:

```
$GLOBALS['HACKLIB_ROOT'] = __DIR__ . '/hacklib/hacklib.php';
```

## Conversions

The Hack transpiler will examine any file with `<?hh` in the hopes of converting it to a non-Hack `<?php`. It will try to perform the following conversions:

* Remove type annotations.
* [Lambdas](../lambdas/intro.md) are changed to closures.
* [Shapes](../shapes/intro.md) are changed to arrays.
* [Enums](../enums/intro.md) are converted to classes.
* [Attributes](../attributes/intro.md) are removed.
* [Collection](../collections/intro.md) are supported via the Hack library in PHP. Any collection literal syntax is replaced with `new`.

### Unsupported Conversions

The following conversions are unsupported:

* [Async](../async/intro.md) functions require Hack-aware runtime support (e.g., HHVM) and thus are not converted.
* The [`__Memoize`](../attributes/special.md#__memoize) attribute requires a Hack-aware runtime and are not converted. 
* Traits that implement interfaces.
* Collection literals that have initial values for non-static properties since we have to convert those literals to `new`, and `new` is not supported on property initializers. Static properties can be moved outside the class.

## Guidelines

* Do not edit a transpiled file. Comments are stripped. Formatting may not be preserved. Treat the transpiled code as machine generated, which it is.
* All non-Hack `<?hh` files in the transpiler directory path are copied to the destination directory unmodified.
* If one file cannot be converted correctly, the transpiler gives up on that file. There are no partial conversions.

