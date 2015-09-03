# Introduction

An example of a generic class is `Vector<T>`, from the Hack collections
implementation. `T` is called a _type parameter_, and it is what makes Vector
generic. It can hold any type of value, from int to an instance of a class.
However, for any instantiation of the class, once a type has been associated
with `T`, it cannot be changed to hold any other type.

@@ intro-examples/vector.php @@

`$x` is a `Vector<int>`, while `$y` is a `Vector<string>`. A `Vector<int>` and
`Vector<string>` are not the same type.

Methods and functions can also be generic. One use case is when they need to
manipulate generic classes:

@@ intro-examples/box.php @@

The above example shows a generic function `swap<T>()` operating on a generic
`Box<T>` class.

Generics allow developers to write one class or method with the ability to be
parameterized to any type, all while preserving type safety. Without generics,
accomplishing a similar model would require creating `BoxInt` and `BoxString`
classes, and that quickly gets verbose. Alternatively, we could treat `$value`
as a `mixed` type and doing `instanceof()` checks, which means that inserting
a string into a box of int would not raise a typechecker error, but would only
be discovered at runtime.
