A *generic type argument* can be a type-specifier or a name that is a type parameter. Either way, at runtime, it is used in place of the 
corresponding type parameter. A generic type argument can either be open or closed ([$$](open-and-closed-generic-types.md)).

```Hack
final class Pair<Tv1, Tv2> implements ConstVector<mixed> {
  ...
  public function getIterator(): KeyedIterator<int, mixed> { ... }
  public function keys(): Vector<int> { ... }
  public function toMap(): Map<int, mixed> { ... }
  public function zip<Tu>(Traversable<Tu> $iter): Vector<Pair<mixed, Tu>> {...}
}
```

In this case, the type specifiers `ConstVector<mixed>`, `KeyedIterator<int, mixed>`, `Vector<int>`, `Map<int, mixed>`, `Traversable<Tu>`, 
`Vector<Pair<mixed, Tu>>`, and `Tu`, and are type arguments.
