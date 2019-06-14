A type parameter is introduced in the corresponding type, method, or function declaration. All other uses of that type parameter occur
in type specifiers for the declaration of properties, function parameters, and function returns. Each such use can be classified as
follows: An *open generic type* is a type that contains one or more type parameters; a *closed generic type* is a type that is not an open generic type.

At run-time, all of the code within a generic type, method, or function declaration is executed in the context of the closed generic
type that was created by applying type arguments to that generic declaration. Each type parameter within the generic type, method, or
function is associated to a particular run-time type. The run-time processing of all statements and expressions always occurs with
closed generic types, and open generic types occur only during compile-time processing.

Two closed generic types are the same type if they are created from the same generic type declaration, and their corresponding type
arguments have the same type.

Consider the following:

```Hack
final class Vector<Tv> implements MutableVector<Tv> {
  ...
  public function zip<Tu>(Traversable<Tu> $it): Vector<Pair<Tv, Tu>> { ... }
}
```

The type parameter `Tv` is introduced in the declaration of the generic type `Vector`. That type parameter is then used in the
type-specifiers `MutableVector<Tv>` and `Vector<Pair<Tv, Tu>>`, both of which are open generic types. The type parameter `Tu` is
introduced in the declaration of the generic function `zip`. That type parameter is then used in the type-specifiers `Traversable<Tu>`
and `Vector<Pair<Tv, Tu>>`, both of which are open generic types.

In the following case:

```Hack
final class Pair<Tv1, Tv2> implements ConstVector<mixed> {
  ...
  public function getIterator(): KeyedIterator<int, mixed> { ... }
  public function keys(): Vector<int> { ... }
  public function toMap(): Map<int, mixed> { ... }
  public function zip<Tu>(Traversable<Tu> $iter): Vector<Pair<mixed, Tu>> {...}
}
```

the type specifiers `Traversable<Tu>`, `Tu`, and `Vector<Pair<mixed, Tu>>` are all open generic types, while the type specifiers
`ConstVector<mixed>`, `KeyedIterator<int, mixed>`, `Vector<int>`, and `Map<int, mixed>` are all closed generic types.

Static properties specified in a generic type are properties of an open generic type. Type arguments of a static are *not* associated with
a particular run-time type, and thus it is an error to have a static property within a generic type.

Consider the following case:

```Hack
final class Foo<T> {
  public static T $x;    // error
}

function main(): void {
  $i = new Foo(4);
  $s = new Foo("Hi");
}
```

Since the static `$x` is part of the open generic type, there is no way to bind `$x` to a particular type (in this case an `int` or `string`).
