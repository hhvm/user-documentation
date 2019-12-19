The preferred object types for providing container-like storage and operations are
`vec`, `dict`, and `keyset`.  These supersede the earlier Hack types
[Vector, Map, and Set](#legacy-vector-map-and-set), and the
[legacy array](#legacy-array) type inherited from PHP. Additional special types,
[varray and darray](#migrating-from-legacy-arrays), exist to provide a migration
path for code that currently relies on legacy arrays, and should not be used
otherwise.

Note that the plan is for both legacy arrays, and these migration types, to be
eventually removed from the Hack language. We expect this to happen at some
point during 2020.

## vec

A vec (short for vector) is a data structure that contains a collection of zero or more elements whose values are each accessed through a
corresponding `int` key. As the number of elements in a vec can change at runtime, a vec type declaration does *not* include an element count.
Consider the following class properties:

```Hack
private vec<string> $colorsVec = vec["red", "white", "blue"];
private vec<num> $valuesVec = vec[123, 567.89];
```

`$colorsVec` has an implicit key type of `int`, and an explicit value type of `string`.  The vec is created and initialized using a *vec-literal*,
which has the general form `vec[`...`]`. There are three elements, and their corresponding keys are 0, 1, and 2. `$valuesVec` has an implicit key
type of `int`, and an explicit value type of `num`.  There are two elements (of type `int` and `float`, respectively), and their corresponding keys
are 0 and 1.

An existing element is accessed via the subscript operator, `[]`, and the value of an element can be changed; however, new values can only be added
to the end by using subscript `[]`, and key values always start at 0, and go up in increments of 1. Consider the following:

@@ arrays-examples/vec-colors.php @@

The `foreach` statement can be used to iterate over the elements in a vec, starting at the element with key 0. This statement provides a way to
access the key and value for each element.

Elements *cannot* be removed from a vec.

## dict

While a vec always has a key type of int, a dict (short for dictionary) requires the key type to be specified. As the number of elements in a
dict can change at runtime, a dict type declaration does *not* include an element count.  Consider the following class properties:

```Hack
private dict<int, string> $colorsDict = dict[1 => "white", 2 => "blue", 0 => "red"];
private dict<int, num> $valuesDict = dict[0 => 123, 1 => 567.89];
```

A dict has an explicit key type, as well as a value type.  In this example, the dict is created and initialized using a *dict-literal*, which
has the general form `dict[`...`]`, in which explicit key values are required. Unlike a vec, key values in a dict need not start at 0, nor need
they be consecutive.

Note, carefully, that although `$colorsVect` and `$colorsDict` result in collections of `int`/`string` pairs, these variables do *not* have the
same (or even compatible) types! That said, there are library functions to convert between vec and dict objects.

Consider the following:

@@ arrays-examples/dict-colors.php @@

The key type can be `string`; for example:

```Hack
private dict<string, int> $fruitDict = dict['oranges' => 25, 'apples' => 12, 'pears' => 17];
```

The key type **must** be `int` or `string`. The `arraykey` type, representing a
union of `int` and `string`, is also allowed, resulting in a dict that accepts
both `int` and `string` keys (but, barring some special cases such as migrating
from untyped code, it's usually better to be explicit and choose only one key
type).

A dict is represented as an ordered map in which each entry is a key/value pair that represents an element. Duplicate keys are not permitted.
The order of the elements in the map is the order in which the elements were inserted into the dict. An element is said to *exist* once it has
been inserted into the dict with a corresponding key. A dict is *extended* by initializing a previously non-existent element using a new key.

The `foreach` statement can be used to iterate over the elements in a dict, in their order of insertion. This statement provides a way to access
the key and value for each element.

To remove an element from a dict, use `unset`.

## keyset

A keyset is a data structure that contains an ordered collection of zero or more elements whose values are the keys. And as array keys must have
type `int` or `string`, keysets are restricted to homogenous collections of
values of those types (the `arraykey` type can be used to declare a keyset that
accepts both `int` and `string` values, but it's usually better to be explicit
and choose only one type). As the number of elements in a keyset
can change at runtime, a keyset type declaration does *not* include an element count.  Consider the following class properties:

```Hack
private keyset<string> $colorsSet = keyset["red", "white", "blue"];
private keyset<int> $valuesSet = keyset[22, 55, 77, 99];
private keyset<arraykey> $thingsSet = keyset["red", "white", 123];
```

`$colorsSet` has a key and value type of `string`.  The keyset is created and initialized using a *keyset-literal*, which has the general
form `keyset[`...`]`. There are three elements, and their corresponding keys are their values. `$valuesSet` has a key and value type of `int`.
`$thingsSet` has a key and value type of `arraykey`, so it can contain both `int`- and `string`-typed elements.

An existing element is accessed via the subscript operator, `[]`; the value of an element cannot be changed. And new values can only be added
by using subscript `[]`. Consider the following:

@@ arrays-examples/keyset-colors.php @@

Attempts to add duplicate keys are accepted but ignored.

The `foreach` statement can be used to iterate over the elements in a keyset, in their order of insertion.

A keyset can also be constructed from any Traversable type, using the traversable constructor. For example:

```Hack
$array = array('a', 'b', 'c');
$set = keyset($array); // constructs $set from an array
```

To check membership in a keyset, use `C\contains` or `C\contains_key`. To remove an element from a keyset, use `unset`.

Similar to `dict`, the order of the elements in a keyset is the order in which the elements were inserted.

## Using dicts, keysets, and vecs

Hack arrays are generally manipulated using the `C\`, `Dict\`, `Keyset\` and `Vec\` functions from the [Hack Standard Library](/hsl/reference); the most common operations are:

| Operation                 | `vec`                        | `dict`                         | `keyset`
| ---------                 | -----                        | ------                         | --------
| Initialize empty          | `$v = vec[];`                | `$d = dict[];`                 | `$k = keyset[];`
| Literal                   | `$v = vec[1, 2, 3];`         | `$d = dict['foo' => 1];`       | `$k = keyset['foo', 'bar'];`
| From Another Container*   | `$v = vec($container);`      | `$d = dict($keyed_container);` | `$k = keyset($container);`
| Keys from Container*      | `$v = Vec\keys($container);` | N/A                            | `$k = Keyset\keys($container);`
| Add Elements              | `$v[] = 4;`                  | `$d['baz'] = 2;`               | `$k[] = 'baz';`
| Bulk Add Elements         | `$v = Vec\concat($t1, $t2)`  | `$d = Dict\merge($kt1, $kt2)`  | `$k = Keyset\union($t1, $t2)`
| Remove Elements           | `$v = Vec\concat(Vec\take($t1, $n), Vec\drop($t1, $n + 1)` | `unset($d['baz']);` | `unset($k['baz']);`
| Key Existence             | `C\contains_key($v, 1)`      | `C\contains_key($d, 'foo')`    | `C\contains_key($k, 'foo')`
| Value Existence           | `C\contains($v, 3)`          | `C\contains($d, 2)`            | N/A
| Get or default            | `idx($v, 0, 999)`            | `idx($d, 'foo', 'default')`    | N/A
| Equality (Order-Dependent) | `$v1 === $v2`               | `$d1 === $d2`                  | `$k1 === $k2`
| Equality (Order-Independent) | N/A                       | `Dict\equal($d1, $d2)`         | `Keyset\equal($k1, $k2)`
| Count Elements (i.e., length, size of array) | `C\count($v)` | `C\count($d)`              | `C\count($k)`
| Type Signature            | `vec<Tv>`                    | `dict<Tk, Tv>`                 | `keyset<Tk>`
| Type Refinement           | `$v is vec<_>`               | `$d is dict<_, _>`             | `$k is keyset<_>`
| `Awaitable` Consolidation | `Vec\from_async($v)`<span class="fbOnly apiAlias">`Vec\gen($v)`</span> | `Dict\from_async($d)`<span class="fbOnly apiAlias">`Dict\gen($d)`</span> | `Keyset\from_async($x)`<span class="fbOnly apiAlias">`Keyset\gen($x)`</span>

`$container` can be a `dict`, `keyset`, `vec`, or one of the legacy types of containers described below.

## Legacy Vector, Map, and Set

**These container types should be avoided in new code; use `dict<Tk, Tv>`, `keyset<T>`, and `vec<T>` instead.**

Early in Hack's life, the library provided mutable and immutable generic class types called: `Vector`, `ImmVector`, `Map`, `ImmMap`, `Set`,
and `ImmSet`. However, these have been replaced by `vec`, `dict`, and `keyset`, whose use is recommended in all new code. Each generic type
had a corresponding literal form. For example, a variable of type `Vector<int>` might be initialized using `Vector {22, 33, $v}`, where `$v`
is a variable of type `int`.

`Vector`s, `Map`s and `Set`s are generally interacted with via instance methods on the classes.

| Operation                 | `Vector`                    | `Map`                    | `Set`
| ---------                 | -----                       | ------                   | --------
| Initialize empty          | `$v = Vector {};`           | `$m = Map {};`           | `$s = Set {};`
| Literal                   | `$v = Vector {1, 2, 3};`    | `$m = Map {'foo' => 1};` | `$s = Set {'foo', 'bar'};`
| Add Elements              | `$v[] = 4;`                 | `$m['baz'] = 2;`         | `$s[] = 'baz';`

## PHP arrays: array, varray and darray

**These container types should not be used in new code, and we aim to remove them from the language; use `dict<Tk, Tv>`, `keyset<T>`, and `vec<T>`**

An `array` is a legacy container type inherited from PHP; it can represent a keyed container (`array<Tk, Tv>` like `dict<Tk, Tv>`) or
an unkeyed container (`array<Tv>` like `vec<Tv>`) - or these behaviors can be mixed, or unspecified (`array` without generics).

We aim to remove `array` from the language by making it practical to replace `array`s with either `vec` or `dict`; the `varray` (vec-like array) and `darray`
(dict-like array) types exist to make this practical.

While migrating directly from `array`, `varray`, and `darray` to `vec`/`dict`/`keyset` may be desirable and practical in small projects, it is extremely difficult
to make this change safely in large legacy codebases, so we are instead adjusting the way the types work over time:

1. identify which `array`s should probably be `vec`s and which should be `dict`s
2. mark these with the special types `varray<T>` (instead of `vec<T>`) and `darray<Tk, Tv>` (instead of `dict<Tk, Tv>`)
3. use runtime logging to locate when a `varray` is used like a keyed container and when a `darray` is used like an unkeyed container (e.g. when appended to)
4. gradually make `varray` behave more like `vec` and `darray` behave more like `dict`
5. remove the `varray` type when it behaves identically to `vec`, and remove the `darray` type when it behaves identically to `dict`


Common operations include:

| Operation                 | `varray`                | `darray`
| ---------                 | -----                   | ------
| Initialize empty          | `$v = varray[];`        | `$m = darray[];`
| Literal                   | `$v = varray[1, 2, 3];` | `$m = darray['foo' => 1];`
| Add Elements              | `$v[] = 4;`             | `$m['baz'] = 2;`
| Remove elements           | `unset($v[$x]);` (may convert to `darray` if not last element) | `unset($m['baz'])`

`varray` and `darray` also include additional legacy behaviors from PHP arrays that do not fit with the Hack type system; for example, in HHVM 4.36, invalid array keys can be used at runtime
and are silently converted to a valid `arraykey`:

```Hack
$x = darray[false => 123];
var_dump(array_keys($x)[0]);
// int(0), not `bool(false)`
```

Additionally, the `varray_or_darray<T>` type is an alias of `varray<T> | darray<_, T>`; on HHVM 4.36, `array` is an alias of this type, but this will be removed in the near future. This type should
be avoided wherever possible.

### Runtime options

By default, `varray` and `darray` are interchangeable at runtime; this can be changed, as can some legacy PHP array behaviors, depending on the HHVM version.

The available runtime options change frequently; to get an up-to-date list, search `ini_get_all()` for settings beginning with `hhvm.hack_arr`; in general:
- a value of `0` means no logging
- `1` means a warning or notice is raised
- `2` means a recoverable error is raised

### `.hhconfig` options

- `disallow_array_literal=true` disallows `array(...)` and `[...]`, forcing all
  such literals to be converted to either `varray[...]` or `darray[...]`. This
  option causes errors on HHVM versions prior to 4.25 due to various `array`
  literals in built-in functions, so it's only useful with newer versions of
  HHVM.
- `disallow_array_typehint=true` disallows using `array`, with or without
  generic type parameters, in any type annotations (function parameters, return
  values, instance variables, etc.). Currently, this option also causes errors
  because of various `array` typehints in built-in functions, which makes it
  hard to use, but will likely become more useful in the future, as these
  functions are migrated.

## Converting to legacy collections and PHP arrays

| Converting    | To `Vector`              | To `Map`      | To `Set`              | To `varray`          | To `darray`
| ----------    | -----------              | --------      | --------              | ----------           | ------
| `dict`        | N/A                      | `new Map($d)` | N/A                   | N/A                  | `darray($d)`
| `dict` keys   | `Vector::fromKeysOf($d)` | N/A           | `Set::fromKeysOf($d)` | `array_keys($d)`<span class="fbOnly apiAlias">`PHP\array_keys($d)`</span> | N/A
| `dict` values | `new Vector($d)`         | N/A           | `new Set($d)`         | `varray($d)`         | N/A
| `vec`         | `new Vector($v)`         | `new Map($v)` | `new Set($v)`         | `varray($v)`         | `darray($v)`
| `keyset`      | `new Vector($k)`         | `new Map($k)` | `new Set($k)`         | `varray($k)`         | `darray($k)`
