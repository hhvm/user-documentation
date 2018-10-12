A *type constraint* in a generic type parameter indicates a requirement that a type must fulfill in order to be accepted as a type 
argument for a given type parameter. (For example, it might have to be a given class type or a subtype of that class type, or it might 
have to implement a given interface.)

Consider the following example in which function `max_val` has one type parameter, `T`, and that has a constraint, `num`:

@@ type-constraints-examples/max-val.php @@

Without the `num` constraint, the expression `$p1 > $p2` is ill-formed, as a greater-than operator is not defined for all types. By 
constraining the type of `T` to `num`, we limit `T` to being an `int` or `float`, both of which do have that operator defined.
