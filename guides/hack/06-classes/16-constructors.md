A constructor is a specially named instance method that is used to initialize the instance immediately after it has been created.  A
constructor is called by the [`new` operator](../expressions-and-operators/new.md).  For example:

@@ constructors-examples/Point.php @@

A constructor has the name `__construct`.  As such, a class can have only one constructor.  (Hack does *not* support method overloading.)

When `new Point` causes the constructor to be called, the argument 2.3 maps to the parameter `$x`, and the default value 0 is mapped to
the parameter `$y`.  The constructor body is then executed, which results in the instance properties being initialized and the Point count
being incremented.  Note that a constructor may call any *private* method in its class, but no public methods.

A constructor does not require a return type, but if one is included, it must be `void`.

Consider the following example in which one of the constructor parameter declarations contains a visibility modifier:

@@ constructors-examples/visibility-on-parameter.php @@

The second parameter contains the visibility modifier `private`, which causes a corresponding private property called `$p2` to be
added to the class, and which is initialized automatically by the value of the second argument passed in.  This simply provides a
programming shortcut by having the implementation declare and initialize such properties.  However, this approach violates data hiding
by admitting publicly in the constructor's calling interface the name and type of a private data member.  Can we use this approach with
the Point class?  No, not as we've designed it.  Our private properties have type `float`, so any arithmetic coordinate value can be
represented, yet we've declared the parameters to the constructor to have type `num`, so either integer or floating-point values can
be passed in.  Specifically, the type of the private members is *not* the same as their corresponding parameters!  Using the following
short-hand notation:

```Hack
public function __construct(private num $x = 0, private num $y = 0) { ... }
```

this results in both private properties having type `num` instead of `float`, and that we don't want!

While it is often the case that there is a one-for-one correspondence between a constructor's parameters and the class's private
properties, this need not be so.  In fact, that's one reason to use data hiding.  For example, an alternate way of representing a
point is to use Polar Coordinates; that is, using an angle and a distance from the origin.  **Don't advertise/promise the internal
representation of an object in its constructor argument list!**
