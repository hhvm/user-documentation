This intrinsic function converts the value of an expression to `string` (if necessary) and writes the string to standard output.  For example:

@@ echo-examples/basics.php @@

For value substitution in string literals, see [$$](../source-code-fundamentals/literals.md#string-literals__double-quoted-string-literals). 
For conversion to string, see [$$](../types/type-conversion.md#conversion-to-string).

`echo` cannot output an array.  However, `echo` can output the value of an object *provided* its type defines 
a [`__toString` method](../classes/methods-with-predefined-semantics.md#method-__tostring).  For example:

@@ echo-examples/Point.php @@
