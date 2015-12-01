PHP has an [autoloading](http://php.net/manual/en/language.oop5.autoload.php) mechanism, via `spl_autoload_register()` to where classes can be automatically loaded at runtime, reducing the need for a bunch of `require` and `include` statements at the beginning of a script.

The HHVM runtime enhances this autoloading by being able to autoload functions, constants, and traits, in addition to classes.

The interface for this enhanced autoloading is a Hack function called `HH\autoload_set_paths()`. This function takes two arguments: an `array` map of what to autoload and a `string` root path from where to start the autoloading.

## Syntax

```
HH\autoload_set_paths(<autoload array map>, <root path for autoloading>);
```

The `<autoload array map>` is an `array` that has the following syntax:

```
$map = array(
    <'function' | 'class' | 'constant' | 'type'> => 
    array(<name of entity> => <path to file of entity>,...,),
    ['failure'] => <callback to call on autoload fail>
);
```

`failure` is an optional key. And the callback can be a closure or an actual function. The parameters must be `string`, `string`, representing the kind and name of what failed.

e.g.,

```
$map = array(
    'class' => array('A' => 'lib/A.php', 'B' => 'lib/B.php'),
    'function' => array('foo' => 'lib/MyFile.php')
    'failure' => function($kind, $name) { echo "Autoload fail: $kind, $name\n"; }
);
```

## Examples

### Success

Here is an example of using the enhanced autoloading and being successful.

@@ autoloading-examples/success.php @@

### Failure

Here is an example of using the enhanced autoloading and failing.

@@ autoloading-examples/failure.php @@

We tried to use the autoloaded function so we got both the message that the autoload failed and a fatal error.

## Caveats

* For functions, the name in the autoload map is *lowercase sensitive*. This may be a bug, but it is that way right now. So if you have a function called `Foo` that you are autoloading, the map needs to have `foo`.
* If your failure callback returns `?bool` , and you are autoloading a class, returning `false` will raise a fatal error as normal when trying to use the class (just like a function). If you return `null`, then it falls back to normal `spl_autoload_register` autoloading.
* The failure callback should be used primarily as a logging mechanism.
