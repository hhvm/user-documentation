
## Basics 
Readonly values cannot be written to normal container types(such as`vec`, `Vector`, or `dict`):

``` Hack
function container_example(readonly Foo $x) : void {
  $container = vec[];
  $container[] = $x; // error, $x is readonly
}
```

To use readonly values within a containers, you can either declare the values in a array literal, or declare a array type (i.e. `vec` or `dict`) as readonly and append to it. 
Note that the entire container literal is readonly if any of its contents are readonly. 

``` Hack
function container_example2(readonly Foo $x) : void {
  $container = readonly vec[]; // container is now a readonly vec
  $container_literal = vec[new Foo(), readonly new Foo()]; // $container_literal is readonly
}
```

Foreaching over a readonly container results in readonly values:

``` Hack
function container_foreach(readonly vec<Foo> $vec): void {
  foreach($vec as $elem) {
    $elem->prop = 3; // error, $elem is readonly
  }
}
```

### Readonly and Collection types
Readonly has only limited support with object types like `Vector`, `Map` and `Pair`. Specifically, you can declare readonly collection literals of readonly values to create a readonly collection type(i.e a `readonly Vector<Foo>`), but since collection types themselves are mutable objects, you cannot append to a readonly collection. 

``` Hack
function collection_example(): void {
  $v = Vector { new Foo(), readonly new Foo() }; // $v is readonly since at least one of its contents is readonly
  $v[] = new Foo(); // error, $v is readonly and not a value type, so it cannot be appended
}
```
