A property is either a class-specific variable belonging to the class as a whole (in which case, it's declared `static`),
or belonging to each instance of that class (in which case, `static` is absent).  Each property has its own visibility.
For example:

@@ properties-examples/Point.php @@

Each instance of `Point` gets it own private set of x- and y-coordinates (the properties `$x` and `$y`, respectively), whose
values are set by the constructor when `new` is used to create an instance.  The initializer for an instance property, if
any (there are none in this example), is applied *prior* to the constructor starting execution.

Being `static`, property `$pointCount` belongs to the class as a whole.  It starts out at zero and is incremented by one by
the constructor each time a new Point is created.

Note carefully, how we access the instance properties in the constructor, `__construct`.  We *cannot* access them by using
their short names, `$x` and `$y`.  In any event, those would refer to local variables of that name, in this case, the method's
parameters!   When an instance method is called, the location of the Point on which it was called to operate is passed secretly
to the called method inside of which it is available by the reserved name `$this`.  So, to access property `$x` in the Point
referred to by `$this`, we use the [member-selection operator, `->`](../expressions-and-operators/member-selection.md), as
in `$this->x`.  **There is no $ in front of the property name!** (Static methods do *not* have a `$this`, so this approach
is *not* used to access a static property, as we can see.)

Consider the case of a public property that we wish to access outside a method of its class.  As we're not inside the class,
no `$this` is available to us; however, we will have the name of the object containing that property, and we can use that
along with the `->` operator to select that property.

A static property exists regardless of whether any instances of its parent class exist.

By making the data implementation of a class private, we are practising *data hiding*, one of the basic principles of
object-oriented programming.

All properties of non-nullable type *must* be initialized during object creation either by an explicit initializer or
by the constructor, except that properties of nullable type that are *not* initialized either way take on the value `null`.

