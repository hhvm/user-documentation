The type name `this` refers to *the current class type at run time*. As such, it can only be used from within a class, an interface, or
a trait. (The type name `this` should not be confused with [`$this`](../source-code-fundamentals/names.md), which refers to *the current
instance*, whose type is `this`.)  For example:

@@ this-examples/this.php @@

Here, the function `get_ID` returns a value whose type is based on the type of the class that implements this interface type.

Strictly speaking, `this` is *not* a new type name, just an alias for an existing one.
