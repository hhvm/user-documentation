If you have create a class in Hack or PHP, you probably have seen a pattern like this:

@@ constructor-parameter-promotion-examples/duplication.php @@

Basically, you essentially repeating the class properties multiple times: at declaration, in the constructor parameters and in the assignment. This can be quite cumbersome.

With constructor parameter promotion, all that repetitive boilerplate is removed.

@@ constructor-parameter-promotion-examples/promotion.php @@

All you do is put a modifier in front of the constructor parameter name and everything else in the previous example is done automatically, including the actual creation of the property.

## Rules

* A modifier of `private`, `protected` or `public` must precede the parameter name in the constructor.
* Other, non-class property parameters may also exist in the constructor, as normal.
* You can put [type annotations](../types/annotations.md) between the modifier and the name.
* The parameters can have a default value.
* Other code in the constructor is run **after** the parameter promotion assignment.
