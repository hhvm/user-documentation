Hack's position on top-level code is two-fold:

- It is essentially not allowed in strict mode, save for a few exceptions.
- It is not typechecked in any [mode](../17-typechecker/05-modes.md)

## Typechecking

In all modes, but strict, you can have top-level code, but it won't be typechecked. It will essentially be ignored by the typechecker and you are on your own with respect to guaranteeing type accuracy and safety.

@@ 02-top-level-examples/typechecking.php @@

The above example will typecheck cleanly, but it will fail at runtime with a catchable fatal error telling you that a `bool` was passed to function that expected an `int`.

## Strict Mode

Unless your code is one of the few allowed at the top-level by strict mode, the typechecker will throw an error. Taking the same example as above, but making it strict, you will get typechecking error now.

@@ 02-top-level-examples/strict.php.notypecheck @@

The following are allowed at the top-level in strict mode

- `require`, `include`, `require_once`, `include_once`
- `class`, `function` `namespace`, and `use` declarations

### Using Strict Code

If you want your current top-level code (or new code, for that matter) to be compatible with strict mode, the best option is to wrap all your top-level code in a function, and make any necessary call to that function from one *partial* mode file that is included in the strict mode file.

@@ 02-top-level-examples/good-strict.php @@
@@ 02-top-level-examples/include-partial.inc.php @@

Your strict file will typecheck fine. Your partial file still won't be typechecked, so make that file as small as possible with minimal type usage.
