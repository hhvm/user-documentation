In Hack, variables can be converted into some external form suitable for use in file storage or inter-program communication. The process of
converting to this form is known as *serialization* while that of converting back again is known as *unserialization*. These facilities are
provided by the library functions [`serialize`](http://www.php.net/serialize) and [`unserialize`](http://www.php.net/unserialize),
respectively. (Library function [`serialize_memoize_param`](http://www.php.net/serialize_memoize_param) helps when serializing parameters
to async functions.)

In the case of variables that are objects, on their own, these two functions serialize and unserialize all the instance properties, which may
be sufficient for some applications. However, if the programmer wants to customize these processes, they can do so by implementing the interface
`Serializable`, which requires defining two methods, `serialize` and `unserialize`.

Consider a `Point` class that not only contains x- and y-coordinates, it also has an `id` property; that is, each distinct `Point` created
during a program's execution has a unique numerical id. However, there is no need to include this when a `Point` is serialized. It can simply
be recreated when that `Point` is unserialized. This information is transient and need not be preserved across program executions. (The same
can be true for other transient properties, such as those that contain temporary results or run-time caches.) Furthermore, consider a class
`ColoredPoint` that extends `Point` by adding a `color` property. The following code shows how these classes need be defined in order for both
`Points` and `ColoredPoints` to be serialized and unserialized:

@@ serialization-examples/Point.php @@

The custom method `serialize` calls the library function `serialize` to create a string version of the array, whose keys are the names of
the instance properties to be serialized. The insertion order of the array is the order in which the properties are serialized in the resulting
string. The array is returned.

The custom method `unserialize` converts the serialized string passed to it back into an array. Because a new object is being created, but
without any constructor being called, the `unserialize` method must perform the tasks ordinarily done by a constructor. In this case, that
involves assigning the new object a unique id.

@@ serialization-examples/serial1-test.php @@

The call to the library function `serialize` calls the custom `serialize` method. Afterwards, the variable `$s` contains the serialized
version of the `Point(2.0,5.0)`, and that can be stored in a database or transmitted to a cooperating program. The program that reads or
receives that serialized string can convert its contents back into the corresponding variable(s).

The call to the library function `unserialize` calls the custom `unserialize` method. Afterwards, the variable `$s` contains a new `Point(2.0,5.0)`.

@@ serialization-examples/ColoredPoint.php @@

As with class `Point`, the custom method `serialize` returns an array of the instance properties that are to be serialized. However,
in the case of the second element, an arbitrary key name is used, and its value is the serialized version of the base Point within the
current `ColoredPoint` object. The order of the elements is up to the programmer.

As `ColoredPoint` has a base class, it unserializes its own instance properties before calling the base class's custom method, so it
can unserialize the `Point` properties.

@@ serialization-examples/serial2-test.php @@

Note carefully that the two test programs have several deficiencies, to work around a type checking/runtime problem. Specifically,
they are *not* in `// strict` mode, and the parameter to `unserialize` has no type hint. Also, the approach used is that inherited
from PHP, and uses the type `array`. New Hack code should *not* use this type if it can be avoided.
