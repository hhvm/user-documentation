A class declaration defines a named-class type, and the data and method members associated with that type.  The following kinds of
members are permitted:
* [Constants](constants.md) -- the constant values associated with the class.
* [Properties](properties.md) -- the variables of the class or of each instance of that class.
* [Methods](methods.md) -- the computations and actions that can be performed on behalf of the class or on any instance of that class.
* [Constructor](constructors.md) -- the actions required to initialize an instance of the class.
* [Type constant](type-constants.md) -- a way of parameterizing class types without using generics.

Here's an extract from a Point class that supports a two-dimensional Cartesian point:

@@ defining-a-basic-class-examples/Point.php @@

The complete set of members of a class are those specified in its declaration along with the [members inherited](inheritance.md)
from its base class, from the [interfaces it implements](implementing-an-interface.md), and from the [traits that it uses](using-a-trait.md).

A number of names (such as `__construct` and `__toString`) are reserved for methods with required semantics, which user-defined
versions must follow. These are described in [$$](methods-with-predefined-semantics.md).

Methods and properties can either be *static* or *instance* members. A static member is declared using `static`. An instance
member is one that is not static.  A static member belongs to the class as a whole, while an instance member applies to a particular instance.
