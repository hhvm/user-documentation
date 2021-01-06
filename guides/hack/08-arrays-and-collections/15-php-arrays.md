PHP arrays are legacy value types for storing iterable data. The types
available are `varray`, `darray`, `varray_or_darray` and `array`
(`array` only in some HHVM configurations). They will eventually be
removed.

PHP arrays are immutable value types, just like Hack arrays. Unlike
Hack arrays, they include legacy behaviors from PHP that can hide
bugs.

For example, in HHVM 4.36, invalid array keys are accepted and
silently coerced to an `arraykey`.

``` Hack
$x = darray[false => 123];
var_dump(array_keys($x)[0]);
// int(0), not `bool(false)`
```

## `varray`

*We recommend using `vec` instead of `varray` for new code.*

A `varray` is an ordered, iterable data structure.

```Hack
// Creating a varray.
function get_items(): varray<string> {
  $items = varray['a', 'b', 'c'];
  return $items;
}

// Accessing items by index.
$items[0]; // 'a'
$items[3]; // throws OutOfBoundsException

// Accessing items that might be out-of-bounds.
idx($items, 0); // 'a'
idx($items, 3); // null
idx($items, 3, 'default'); // 'default'

// Modifying items. These operations set $items
// to a modified copy, and do not modify the original value.
$items[0] = 'xx'; // varray['xx', 'b', 'c']
$items[] = 'd'; // varray['xx', 'b', 'c', 'd']

// Getting the length.
C\count($items); // 4

// Iterating.
foreach ($items as $item) {
  echo $item;
}
// Iterating with the index.
foreach ($items as $index => $item) {
  echo $index; // e.g. 0
  echo $item;  // e.g. 'a'
}

// Equality checks.
varray[1] === varray[1]; // true
varray[1, 2] === varray[2, 1]; // false

// Converting from an Iterable.
varray(vec[10, 11]); // varray[10, 11]
varray(keyset[10, 11]); // varray[10, 11]
```

## `darray`

*We recommend using `dict` instead of `darray` for new code.*

A `darray` is an ordered key-value data structure.

```Hack
// Creating a darray.
function get_items(): darray<string, int> {
  $items = darray['a' => 1, 'b' => 3];
  return $items;
}

// Accessing items by key.
$items['a']; // 1
$items['foo']; // throws OutOfBoundsException

// Accessing keys that may be absent.
idx($items, 'a'); // 1
idx($items, 'z'); // null
idx($items, 'z', 'default'); // 'default'

// Inserting, updating or removing values in a darray. These operations
// set $items to a modified copy, and do not modify the original value.
$items['a'] = 42; // darray['a' => 42, 'b' => 3]
$items['z'] = 100; // darray['a' => 42, 'b' => 3, 'z' => 100]
unset($items['b']); // darray['a' => 42, 'z' => 100]

// Getting the keys.
Vec\keys(darray['a' => 1, 'b' => 3]); // vec['a', 'b']

// Getting the values.
vec(darray['a' => 1, 'b' => 3]); // vec[1, 3]

// Getting the length.
C\count($items); // 2

// Checking if a dict contains a key or value.
C\contains_key($items, 'a'); // true
C\contains($items, 3); // true

// Iterating values.
foreach ($items as $value) {
  echo $value; // e.g. 1
}
// Iterating keys and values.
foreach ($items as $key => $Value) {
  echo $key;   // e.g. 'a'
  echo $value; // e.g. 1
}

// Equality checks. === returns false if the order does not match.
darray[] === darray[]; // true
darray[0 => 10, 1 => 11] === darray[1 => 11, 0 => 10]; // false

// Converting from an Iterable.
darray(vec['a', 'b']); // darray[0 => 'a', 1 => 'b']
darray(Map {'a' => 5}); // darray['a' => 5]
```

## `varray_or_darray`

A `varray_or_darray` is type that can be either a `varray` or
`darray`. It exists to help gradually migrate code to more specific
types, and should be avoided when possible.

```Hack
function get_items(bool $b): varray_or_darray<int, string> {
  if ($b) {
    return varray['a', 'b'];
  } else {
    return darray[5 => 'c'];
  }
}
```

On HHVM 4.36, `array` is an alias for `varray_or_darray`, but this will be removed in the future.

## `array`

An `array` is a legacy container type inherited from PHP. It can
represent a keyed container (`array<Tk, Tv>` like `dict<Tk, Tv>`), an
unkeyed container (`array<Tv>` like `vec<Tv>`), or it can be
unspecified (`array` without generics).

We aim to remove `array` from the language by making it practical to replace `array`s with either `vec` or `dict`. The `varray` (vec-like array) and `darray`
(dict-like array) types exist to make this practical.

While migrating directly from `array`, `varray`, and `darray` to `vec`/`dict`/`keyset` may be desirable and practical in small projects, it is extremely difficult
to make this change safely in large legacy codebases, so we are instead adjusting the way the types work over time:

1. identify which `array`s should probably be `vec`s and which should be `dict`s
2. mark these with the special types `varray<T>` (instead of `vec<T>`) and `darray<Tk, Tv>` (instead of `dict<Tk, Tv>`)
3. use runtime options to turn on logging to locate when a `varray` is used like a keyed container and when a `darray` is used like an unkeyed container (e.g. when appended to)
4. gradually make `varray` behave more like `vec` and `darray` behave more like `dict`
5. remove the `varray` type when it behaves identically to `vec`, and remove the `darray` type when it behaves identically to `dict`

After HHVM version 4.62, the implicit interoperability and interchangeability of `varray`, `darray`, and `array` will be turned off by default and later removed.
After this point, `varray` and `darray` and `array` will behave more like separate types. Specifically:

* Typehints in enforced positions will differentiate `varray` and `darray` and `array` at runtime:
  * If typehint enforcement is turned on, using a `varray` where a `darray` or `array` is expected or any other violating combination thereof will result in a `TypehintViolationException`. This applies to all enforced typehints including parameter typehints, return typehints, and property typehints.
  * If property type enforcement is turned on, property type invariance rules for class hierarchies will apply to `varray` and `darray` and `array`. For example, a child class will not be able to redeclare a property with type `varray<Tv>` if the parent class's property is typed `darray<Tk, Tv>`.
* Attempting to treat a `varray` like a `darray` will result in exceptions instead of implicit promotions:
  * Attempting to set a string key in a `varray` will result in an `InvalidArgumentException`.
  * Attempting to set an index that is not already set in a `varray` will result in an `OutOfBoundsException`.
  * Attempting to unset a non-end index of a `varray` will result in an `InvalidOperationException`.
* Comparison operators will now behave for `varray` and `darray` similarly to how they behave for `vec` and `dict`:
  * Comparing a `varray` with a `darray` or either with an `array` using `==` or `===` will always result in false.
  * Comparing a `darray` with a `varray` or a `darray` using a relational comparator (`>`, `<`, `<=`, `>=`, `<>`, `<=>`) will result in an `InvalidOperationException`.

## Runtime options

In HHVM version 4.62 and earlier, by default, `varray` and `darray` are interchangeable at runtime; this can be changed, as can some legacy PHP array behaviors, depending on the HHVM version.

The available runtime options change frequently; to get an up-to-date list, search `ini_get_all()` for settings beginning with `hhvm.hack_arr`; in general:
- a value of `0` means no logging
- `1` means a warning or notice is raised
- `2` means a recoverable error is raised

The `hhvm.hack_arr_compat_notices` option must be set to true for any of the `hhvm.hack_arr_` options to have an effect.

Individual runtime settings are documented [here](/hack/built-in-types/darray-varray-runtime-options.md).

### `.hhconfig` options

`disallow_array_literal=true` disallows `array(...)` and `[...]`, forcing all
such literals to be converted to either `varray[...]` or `darray[...]`. This
option causes errors on HHVM versions prior to 4.25 due to various `array`
literals in built-in functions, so it's only useful with newer versions of
HHVM.

`disallow_array_typehint=true` disallows using `array`, with or without
generic type parameters, in any type annotations (function parameters, return
values, instance variables, etc.). Currently, this option also causes errors
because of various `array` typehints on built-in functions, which makes it
hard to use, but will likely become more useful in the future, as these
functions are migrated.
