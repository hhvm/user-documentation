# Introduction

Certain types (classes, interfaces, and traits) and their methods can be parameterized; that is, their declarations can have one or more placeholder names called *type parameters* that are associated with types via *type arguments* when a class is instantiated or a method is called. A type or method having such placeholder names is called a *generic type* or *generic method*, respectively. Top-level functions can also be parameterized giving rise to *generic functions*.

An example of a generic class is `Vector<T>`, from the Hack collections implementation. `T` is called a _type parameter_, and it is what makes Vector generic. It can hold any type of value, from int to an instance of a class. However, for any instantiation of the class, once a type has been associated with `T`, it cannot be changed to hold any other type.

@@ introduction-examples/vector.php @@

`$x` is a `Vector<int>`, while `$y` is a `Vector<string>`. A `Vector<int>` and
`Vector<string>` are not the same type.

Methods and functions can also be generic. One use case is when they need to
manipulate generic classes:

@@ introduction-examples/generic-methods.php @@

The above example shows a generic function `swap<T>()` operating on a generic
`Box<T>` class.

Generics allow developers to write one class or method with the ability to be parameterized to any type, all while preserving type safety. Without generics, accomplishing a similar model would require creating `BoxInt` and `BoxString` classes, and that quickly gets verbose. Alternatively, we could treat `$value` as a `mixed` type and doing `instanceof()` checks, which means that inserting a string into a box of int would not raise a typechecker error, but would only be discovered at runtime.

## Arity

The *arity* of a generic type or method is the number of type parameters declared for that type or method. As such, class `Vector` has arity 1. The Hack library generic container class `Map` implements an ordered, dictionary-style collection. This type has arity 2, and utilizes a key type and a value type, so the type `Map<int, Employee>`, for example, could be used to represent a group of Employee objects indexed by an integer employee number.

Within a generic parameter list, the parameter names must
  * be distinct
  * all begin with the letter T
  * not be the same as that used for a generic parameter for an enclosing class, interface, or trait.

In the following case, class `Vector` has one type parameter, `Tv`, so has arity 1). Method `map` also has one type parameter, `Tu`, so has arity 1.

```hack
final class Vector<Tv> implements MutableVector<Tv> {
  …
  public function map<Tu>((function(Tv): Tu) $callback): Vector<Tu> { … }
}
```

In the following case, class `Map` has two type parameters, `Tk` and `Tv`, so has arity 2. Method `zip` has one, `Tu`, so has arity 1.

```hack
final class Map<Tk, Tv> implements MutableMap<Tk, Tv> {
  …
  public function zip<Tu>(Traversable<Tu> $iter): Map<Tk, Pair<Tv, Tu>> { … }
}
```

In the following case, function `maxValue` has one type parameter, `T`, so has arity 1.

```hack
function maxValue<T>(T $p1, T $p2): T { … }
```
