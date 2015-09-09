A widely used feature of PHP, references (`&`), is not supported in Hack. And while this can be especially painful for existing code wanting to convert to Hack's [strict mode](../typechecker/modes.md#strict-mode), there is a very sound reason for not supporting them. The typechecker cannot do proper analysis of code that have references. The typechecker depends on a fundamental set of rules in order to make its decisions (e.g., [type inference](types/inference.md) being local to a function). And references violate many of those rules.

The key example of this violation is that a reference passed to a function is modifiable at the caller site, and the typechecker cannot accurately analyze what may or may not happen at the callee in order to bridge the two. 

## Partial mode

You can use references in partial mode (and, of course decl mode), but they are not typechecked. So use them at your own risk, because with more complicated reference usage, all sorts of interesting things can happen.

@@ references-examples/partial.php @@

There are **no typechecker errors** with this code. However, what does the call to `baz()` return from HHVM? Well notice that none of the functions except `baz()`, return an `int`. They return `void`. Without references, you know that `$x` would be `4` at the end of the call to `baz()`. However, through the convoluted web of all the references, it actually returns `6` here.

## Strict mode

The typechecker does error in strict mode anytime you try to use a reference. 

@@ references-examples/strict.php.type-errors @@
