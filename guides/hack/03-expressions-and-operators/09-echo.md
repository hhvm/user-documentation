This intrinsic function converts the value of an expression to `string` (if necessary) and writes the string to standard output.  For example:

@@ echo-examples/basics.php @@

For a discussion of value substitution in strings, see [string literals](../source-code-fundamentals/literals.md#string-literals__double-quoted-string-literals).
For conversion to strings, see [type conversion](../types/type-conversion.md#converting-to-string).

`echo` cannot output an array.  However, `echo` can output the value of an object *provided* its type defines
a [`__toString` method](../classes/methods-with-predefined-semantics.md#method-__tostring).  For example:

@@ echo-examples/Point.php @@
