Hack supports *inheritance*, a means by which a *derived class* can *extend* and specialize a single *base class*. However, unlike some other
languages, classes in Hack are **not** all derived from a common ancestor.

Every user-defined exception class *must* extend the library class `Exception`.  For example:

@@ inheritance-examples/MyRangeException.php @@

An *abstract* class is a base type intended for derivation, but which cannot be instantiated directly.  A *concrete* class is a class that is not abstract.  In the following example, `Vehicle` and `Aircraft` are abstract types while `PassengerJet` is concrete:

@@ inheritance-examples/Vehicles.php @@

As every Vehicle has a maximum speed, class `Vehicle` declares a method to return that value. However, base class `Vehicle` does *not*
know at runtime if it's the base of a racing car, a sailplane, or a bicycle, so it can't actually calculate that value.  However, by being
abstract that forces any concrete classes ultimately derived from that base to implement that method.  Similarly, base class `Aircraft`
forces its concrete descendants to implement method ` get_max_altitude`.

A *final* class is one from which other classes cannot be derived.  For example:

```Hack
final class MathLibrary {
  private function __construct() {}   // disallows instantiation
  public static function sin(float $p): float { ... }
  ...
}
$v = MathLibrary::sin(2.34);
```

Having the `final` modifier precludes `MathLibrary` from being extended.  Separately, by making the constructor private, we cannot create
objects of this type; it's just a wrapper for a set of static members.

The members of a base class can be *overridden* in a derived class by redeclaring them with the same signature defined in the base class.
However, an overriding [constructor](constructors.md) need *not* have the same signature as defined in the base class (see example below).
(An overriding constructor in a derived class must have the same or a less-restricted visibility than that being overridden in the base class.)

If classes in a derived-class hierarchy have constructors, it is the responsibility of the constructor at each level to call the constructor
in its base-class explicitly, using the notation `parent::__construct(...)`. If a constructor calls its base-class constructor, it should do
so as its first statement, so the object hierarchy is built from the bottom-up. A constructor should not call its base-class constructor more
than once. A call to a base-class constructor searches for the nearest constructor in the class hierarchy. Not every level of the hierarchy
need have a constructor.  For example:

@@ inheritance-examples/ColoredPoint.php @@

A base class can define an abstract type constant&mdash;essentially a name without a concrete type attached&mdash;and subclasses each override
that with a concrete type constant. Conceptually, type constants are to types, as abstract methods are to methods.  A type constant has
public visibility and is implicitly static.  By convention, a type constant's name begins with an uppercase `T`.  Consider the following:

@@ inheritance-examples/type-constants.php @@
