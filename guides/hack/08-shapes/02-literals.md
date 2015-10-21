# Shape Literals

A *shape literal* creates an unnamed shape with fields having values as specified by a list of field-initializers. The order of the field-initializers in that list need not be the same as the order of the field specifiers in the shape type's definition. For example:

@@ shape-literals-examples/literals.php.type-errors @@

A shape literal must initialize all the the fields in the shape.

Note that the term *literal* as used with shapes is a misnomer; the expressions in the field initializers need not be compile-time constants. And even if all the initializers are constant expressions, the resulting shape literal itself is not, so it cannot be used in contexts where such expressions are required.
