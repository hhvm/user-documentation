A method is a class-specific function belonging to the class as a whole (in which case, it's declared `static`) or to each instance of that 
class (in which case, `static` is absent).  Each method has its own visibility.  For example:

@@ methods-examples/Point.php @@

A static method that is visible is callable regardless of whether any instances of its parent class exist.  And as we can see, we call 
`get_point_count` using the [scope-resolution operator, `::`](../expressions-and-operators/scope-resolution.md), preceded by the class name.

When an instance method such as `move` is called, the location of the Point on which it was called to operate is passed secretly to the 
called method inside of which it is available by the reserved name `$this`.  So, to access property `$x` in the Point referred to by `$this`, 
we use the [member-selection operator, `->`](../expressions-and-operators/member-selection.md), as in `$this->x`.  We do likewise to 
access another instance method in that class.  (Static methods do *not* have a `$this`, so this approach is *not* used to access a static 
method, as we can see.)  

Consider the case of a public method (such as `move`) that we wish to access outside a method of its class.  As we're not inside the class, 
no `$this` is available to us; however, we do have the name of the object containing that method, and we can use that along with the `->` 
operator to select that method, as in `$p2->move(-2.2, -4)`. 

The *signature* of a method is a combination of the parent class name, that method's name, and its parameter types.  (Note, however, that 
Hack does *not* support method overloading.)
