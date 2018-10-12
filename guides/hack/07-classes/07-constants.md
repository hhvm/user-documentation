A class may contain definitions for named constants, which have public visibility.  A class constant belongs to the class 
as a whole, so it is implicitly `static`.  For example:

@@ constants-examples/auto-color.php @@

If a class constant's type is omitted, it is inferred from the initializer, which must be present. In this case, that type is `string`.

As we can see, outside its parent class, a class constant's name must be qualified by the 
[scope-resolution operator, `::`](../expressions-and-operators/scope-resolution.md); after all, multiple classes might define 
constants by the same (unrelated) name.
