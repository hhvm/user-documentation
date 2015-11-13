# Collection Semantics

In general, Hack collections should be your first choice when deciding between them and arrays for new code. They provide the readability, performance and type-checkability needed, without sacrificing much in terms of flexibility.

That said, there is one key area where you must be cognizant of the differences between collections and arrays.

## Reference Semantics

Hack collections have *reference semantics*. This means that a collection is treated like an object, and modifications made to a collection will affect any collections that were assigned or somehow copied to it. 

Arrays have *value semantics*. Thus, a modification to an array will have no affect to an array that were assigned or somehow copied to it.

@@ semantics-examples/reference-vs-value.php @@

The above example shows the difference between reference and value semantics. This is even true across function calls as well.

## Converting Arrays to Collections

The fact that arrays have value semantics and collections have reference semantics is actually very important when converting existing code using arrays to collections.

@@ semantics-examples/converting.php @@

So, if you had some automatic code modifier to convert `array` to `Vector`, your code could break as shown by the example above.

One way to help remedy this is to use `ImmVector` and Vector::immutable()` to make sure that you cannot modify the collection when you pass it to the function.

@@ semantics-examples/converting-immutable.php.type-errors @@

## Equality on Collections `==`

Collections can be compared for equality.

```
$coll1 == $coll2;
```

Here are the rules:

1. Are the two collections the same type of collection (mutability ignored)? If no, then equality is `false`.
2. Do the two collections have the same number of values (or keys for maps)? If not, then equality is `false`.
3. For vectors and pairs, is the value at each index equal via `==`? If not, then equality is `false`; otherwise, equality is `true`.
4. For sets, is every value in one contained in the other? If not, then equality is `false`; otherwise, equality is `true`.
5. For maps, does every key in one exist in the other via `===`? If not, then equality is `false`. If so, do the identical keys map to equal values in each collection via `==`? If not, then equality is `false`; otherwise equality is `true`.

@@ semantics-examples/equality.php @@

## Identity on Collections `===`

Collections can be compared for identity.

```
$coll1 === $coll2;
```

Identity only evaluates to `true` if the both collections are the same object. Otherwise, it is `false`.

@@ semantics-examples/identity.php @@

## Using `list()`

You can use [`list()`](http://php.net/manual/en/function.list.php) with  `Vector` and `Pair` just like you can with arrays. 

While you can use `list()` with `Map` and `Set` at runtime, the Hack typechecker will throw an error. Note that you must have a zero integer key and subsequent ordered keys for `Map` and `Set`; otherwise you will get an `OutOfBoundsException`.

@@ semantics-examples/list.php.type-errors @@

## Using Array Built-In Functions

Hack collections can some built-in functions that take arrays.

### Sorting

Method | Valid Collection
-------|-----------------
[`sort()`](http://php.net/manual/en/function.sort.php) | `Vector`
[`rsort()`](http://php.net/manual/en/function.rsort.php) | `Vector`
[`usort()`](http://php.net/manual/en/function.usort.php) | `Vector`
[`asort()`](http://php.net/manual/en/function.asort.php) | `Map`, `Set`
[`arsort()`](http://php.net/manual/en/function.arsort.php) | `Map`, `Set`
[`ksort()`](http://php.net/manual/en/function.ksort.php) | `Map`, `Set`
[`krsort()`](http://php.net/manual/en/function.krsort.php) | `Map`, `Set`
[`usort()`](http://php.net/manual/en/function.usort.php) | `Map`, `Set`
[`uasort()`](http://php.net/manual/en/function.uasort.php) | `Map`, `Set`
[`uksort()`](http://php.net/manual/en/function.uksort.php) | `Map`, `Set`
[`natsort()`](http://php.net/manual/en/function.natsort.php) | `Map`, `Set`
[`natcasesort()`](http://php.net/manual/en/function.natcasesort.php) | `Map`, `Set`

`Pair`s do not support sorting since they are immutable. You can convert the `Pair` to a mutable collection and then do a sort.

### Querying

Method | Valid Collection
-------|-----------------
[`array_keys()`](http://php.net/manual/en/function.array-keys.php) | All
[`array_key_exists()`](http://php.net/manual/en/function.array-key-exists.php) | All 
[`array_values()`](http://php.net/manual/en/function.array-values.php) | All
[`count()`](http://php.net/manual/en/function.count.php) | All
`idx()` | `Vector`, `Map`

`idx()` is a function that takes a collection, index and an optional default return value if the index isn't found (`null` is returned if you don't specify one).

### Manipulation

Method | Valid Collection
-------|-----------------
[`array_combine()`](http://php.net/manual/en/function.array-combine.php) | All
[`array_diff()`](http://php.net/manual/en/function.array-diff.php) | All
[`array_diff_key()`](http://php.net/manual/en/function.array-diff-key.php) | All
[`array_filter`](http://php.net/manual/en/function.array-filter.php) | All
[`array_intersect()`](http://php.net/manual/en/function.array-intersect.php) | All 
[`array_intersect_key()`](http://php.net/manual/en/function.array-intersect-key.php) | All
[`array_map()`](http://php.net/manual/en/function.array-map.php) | All
[`implode()`](http://php.net/manual/en/function.implode.php) | All
[`serialize()`](http://php.net/manual/en/function.serialize.php) | All

### Modification

Method | Valid Collection
-------|-----------------
[`array_pop()`](http://php.net/manual/en/function.array-pop.php) | All
[`array_push()`](http://php.net/manual/en/function.array-push.php) | All
[`array_shift()`](http://php.net/manual/en/function.array-shift.php) | `Vector`, `Set`
[`array_unshift`](http://php.net/manual/en/function.array-unshift.php) | `Vector`, `Set`

### Introspection

Method | Valid Collection
-------|-----------------
[`var_dump()`](http://php.net/manual/en/function.var-dump.php) | All
[`print_r()`](http://php.net/manual/en/function.print-r.php) | All
[`var_export()`](http://php.net/manual/en/function.var-export.php) | All
[`debug_zval_dump`](http://php.net/manual/en/function.debug-zval-dump.php) | All

### APC

Method | Valid Collection
-------|-----------------
[`apc_store()`](http://php.net/manual/en/function.apc-store.php) | All

## Extending

All of the concrete collection classes are `final` (i.e., they cannot be sub-classed). However, you can create new concrete collection classes from the various [interfaces](./interfaces.md) provided by the collections infrastructure
