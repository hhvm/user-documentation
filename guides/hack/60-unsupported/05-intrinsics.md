There are three main intrinsic expressions in PHP that are unsupported in Hack; that is, they are not typechecked in [partial mode](../typechecker/modes.md#partial-mode) and the typechecker errors in strict mode.

- [`isset()`](http://php.net/manual/en/function.isset.php)
- [`empty()`](http://php.net/manual/en/function.empty.php)
- [`unset()`](http://php.net/manual/en/function.unset.php)

The key argument against these intrinsics are that they look like functions, but they are really expressions disguised as functions. You can pass undefined variables, etc.

Also, in Hack, you don't need them. The Hack typechecker can tell you whether a variable has been set. And `array_key_exists()` can tell you whether an element of an array exists.

As for `unset()`, you can just set the variable to `null` to achieve the same effect.



