Names are used to label variables, constants, functions, and user-defined types, among other things. A name *must* begin
with an upper- or lowercase letter or underscore, which can optionally be followed by those same characters or decimal digits.
Furthermore, variable names (which includes function parameter names) and property names *must* be preceded by `$`.  For example:

@@ names-examples/various-names.php @@

The name `$_`, referred to as the *placeholder variable*, is reserved for use in the
[list intrinsic function](../expressions-and-operators/list.md) and the [foreach statement](../statements/foreach.md).

The name `$this` is predefined inside any instance method or constructor when that method is called from within an object context.
`$this` is read-only and designates the object on which the method is being called, or the object being constructed. The type of
`$this` is [`this`](../types/this.md).

Names beginning with two underscores (__) are reserved by the Hack language.
