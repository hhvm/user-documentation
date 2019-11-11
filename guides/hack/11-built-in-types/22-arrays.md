The preferred object types for providing array-like storage and operations are
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

Here is a list of library functions for manipulating a vec:

Name | Description
-----|------------
`HH\Lib\Vec\concat` | Returns a new vec formed by concatenating the given Traversables together
`HH\Lib\Vec\chunk` | Returns a vec containing the original vec split into chunks of the given size
`HH\Lib\Vec\diff` | Returns a new vec containing only the elements of the first Traversable that do not appear in any of the other ones
`HH\Lib\Vec\diff_by` | Returns a new vec containing only the elements of the first Traversable that do not appear in the second one, where an element's identity is determined by the scalar function
`HH\Lib\Vec\drop` | Returns a new vec containing all except the first `$n` elements of the given Traversable
`HH\Lib\Vec\fill` | Returns a new vec of size `$size` where all the values are `$value`
`HH\Lib\Vec\filter` | Returns a new vec containing only the values for which the given predicate returns true
`HH\Lib\Vec\filter_async` | Returns a new vec containing only the values for which the given async predicate returns true
`HH\Lib\Vec\filter_nulls` | Returns a new vec containing only non-null values of the given Traversable
`HH\Lib\Vec\filter_with_key` | Returns a new vec containing only the values for which the given predicate returns true
`HH\Lib\Vec\flatten` | Returns a new vec formed by joining the Traversable elements of the given Traversable
`HH\Lib\Vec\from_async` | Returns a new vec containing the awaited result of the given Awaitables
`HH\Lib\Vec\intersect` | Returns a new vec containing only the elements of the first Traversable that appear in all the other ones
`HH\Lib\Vec\keys` | Returns a new vec containing the keys of the given KeyedTraversable
`HH\Lib\Vec\map` | Returns a new vec where each value is the result of calling the given function on the original value
`HH\Lib\Vec\map_async` | Returns a new vec where each value is the result of calling the given async function on the original value
`HH\Lib\Vec\map_with_key` | Returns a new vec where each value is the result of calling the given function on the original key and value
`HH\Lib\Vec\partition` | Returns a 2-tuple containing vecs for which the given predicate returned true and false, respectively
`HH\Lib\Vec\range` | Returns a new vec containing the range of numbers from `$start` to `$end` inclusive, with the step between elements being `$step` if provided, or `1` by default
`HH\Lib\Vec\reverse` | Returns a new vec with the values of the given Traversable in reversed order
`HH\Lib\Vec\sample` | Returns a new vec containing an unbiased random sample of up to $sample_size elements (fewer iff `$sample_size` is larger than the size of `$traversable`)
`HH\Lib\Vec\shuffle` | Returns a new vec with the values of the given Traversable in a random order
`HH\Lib\Vec\slice` | Returns a new vec containing the subsequence of the given Traversable determined by the offset and length
`HH\Lib\Vec\sort` | Returns a new vec sorted by the values of the given Traversable
`HH\Lib\Vec\sort_by` | Returns a new vec sorted by some scalar property of each value of the given Traversable, which is computed by the given function
`HH\Lib\Vec\take` | Returns a new vec containing the first `$n` elements of the given Traversable
`HH\Lib\Vec\unique` | Returns a new vec containing each element of the given Traversable exactly once
`HH\Lib\Vec\unique_by` | Returns a new vec containing each element of the given Traversable exactly once, where uniqueness is determined by calling the given scalar function on the values

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

Here is a list of library functions for manipulating a dict:

Name | Description
-----|------------
`HH\Lib\Dict\associate` | Returns a new dict where each element in `$keys` maps to the corresponding element in $values
`HH\Lib\Dict\chunk` | Returns a vec containing the original dict split into chunks of the given size
`HH\Lib\Dict\count_values` | Returns a new dict mapping each value to the number of times it appears in the given Traversable
`HH\Lib\Dict\diff_by_key` | Returns a new dict containing only the entries of the first KeyedTraversable whose keys do not appear in any of the other ones
`HH\Lib\Dict\drop` | Returns a new dict containing all except the first `$n` entries of the given KeyedTraversable
`HH\Lib\Dict\equal` | Returns whether the two given dicts have the same entries, using strict equality
`HH\Lib\Dict\fill_keys` | Returns a new dict where all the given keys map to the given value
`HH\Lib\Dict\filter` | Returns a new dict containing only the values for which the given predicate returns true
`HH\Lib\Dict\filter_async` | Returns a new dict containing only the values for which the given async predicate returns true
`HH\Lib\Dict\filter_keys` | Returns a new dict containing only the keys for which the given predicate returns true
`HH\Lib\Dict\filter_nulls` | Given a KeyedTraversable with nullable values, returns a new dict with those entries removed
`HH\Lib\Dict\filter_with_key` | Just like filter, but your predicate can include the key as well as the value
`HH\Lib\Dict\filter_with_key_async` | Like `filter_async`, but lets you utilize the keys of your dict too
`HH\Lib\Dict\flatten` | Returns a new dict formed by merging the KeyedTraversable elements of the given Traversable
`HH\Lib\Dict\flip` | Returns a new dict keyed by the values of the given KeyedTraversable and vice-versa
`HH\Lib\Dict\from_async` | Returns a new dict containing the awaited result of the given Awaitables
`HH\Lib\Dict\from_entries` | Returns a new dict where each mapping is defined by the given key/value tuples
`HH\Lib\Dict\from_keys` | Returns a new dict where each value is the result of calling the given function on the corresponding key
`HH\Lib\Dict\from_keys_async` | Returns a new dict where each value is the result of calling the given async function on the corresponding key
`HH\Lib\Dict\from_values` | Returns a new dict keyed by the result of calling the given function on each corresponding value
`HH\Lib\Dict\group_by` | Returns a new dict where keys are the results of the given function called on the given values
`HH\Lib\Dict\map` | Returns a new dict where each value is the result of calling the given function on the original value
`HH\Lib\Dict\map_async` | Returns a new dict where each value is the result of calling the given async function on the original value
`HH\Lib\Dict\map_keys` | Returns a new dict where each key is the result of calling the given function on the original key
`HH\Lib\Dict\map_with_key` | Returns a new dict where each value is the result of calling the given function on the original value and key
`HH\Lib\Dict\merge` | Merges multiple KeyedTraversables into a new dict
`HH\Lib\Dict\partition` | Returns a 2-tuple containing dicts for which the given predicate returned `true` and `false`, respectively
`HH\Lib\Dict\partition_with_key` | Returns a 2-tuple containing dicts for which the given keyed predicate returned `true` and `false`, respectively
`HH\Lib\Dict\pull` | Returns a new dict where: values are the result of calling `$value_func` on the original value keys are the result of calling `$key_func` on the original value
`HH\Lib\Dict\pull_with_key` | Returns a new dict where: values are the result of calling `$value_func` on the original value/key keys are the result of calling `$key_func` on the original value/key
`HH\Lib\Dict\reverse` | Returns a new dict with the original entries in reversed iteration order
`HH\Lib\Dict\select_keys` | Returns a new dict containing only the keys found in both the input container and the given Traversable
`HH\Lib\Dict\sort` | Returns a new dict sorted by the values of the given KeyedTraversable
`HH\Lib\Dict\sort_by` | Returns a new dict sorted by some scalar property of each value of the given KeyedTraversable, which is computed by the given function
`HH\Lib\Dict\sort_by_key` | Returns a new dict sorted by the keys of the given KeyedTraversable
`HH\Lib\Dict\take` | Returns a new dict containing the first `$n` entries of the given KeyedTraversable
`HH\Lib\Dict\unique` | Returns a new dict in which each value appears exactly once
`HH\Lib\Dict\unique_by` | Returns a new dict in which each value appears exactly once, where the value's uniqueness is determined by transforming it to a scalar via the given function

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

Here is a list of library functions for manipulating keysets:

Name | Description
-----|------------
`HH\Lib\Keyset\chunk` | Returns a vec containing the given Traversable split into chunks of the given size
`HH\Lib\Keyset\diff` | Returns a new keyset containing only the elements of the first Traversable that do not appear in any of the other ones
`HH\Lib\Keyset\drop` | Returns a new keyset containing all except the first `$n` elements of the given `Traversable
`HH\Lib\Keyset\equal` | Returns whether the two given keysets have the same elements, using strict equality
`HH\Lib\Keyset\filter` | Returns a new keyset containing only the values for which the given predicate returns `true`
`HH\Lib\Keyset\filter_async` | Returns a new keyset containing only the values for which the given async predicate returns `true`
`HH\Lib\Keyset\filter_nulls` | Returns a new keyset containing only non-null values of the given Traversable
`HH\Lib\Keyset\filter_with_key` | Returns a new keyset containing only the values for which the given predicate returns `true`
`HH\Lib\Keyset\flatten` | Returns a new keyset formed by joining the values within the given Traversables into a keyset
`HH\Lib\Keyset\from_async` | Returns a new keyset containing the awaited result of the given Awaitables
`HH\Lib\Keyset\intersect` | Returns a new keyset containing only the elements of the first Traversable that appear in all the other ones
`HH\Lib\Keyset\keys` | Returns a new keyset containing the keys of the given KeyedTraversable, maintaining the iteration order
`HH\Lib\Keyset\map` | Returns a new keyset where each value is the result of calling the given function on the original value
`HH\Lib\Keyset\map_async` | Returns a new keyset where the value is the result of calling the given async function on the original values in the given traversable
`HH\Lib\Keyset\map_with_key` | Returns a new keyset where each value is the result of calling the given function on the original key and value
`HH\Lib\Keyset\partition` | Returns a 2-tuple containing keysets for which the given predicate returned `true` and `false`, respectively
`HH\Lib\Keyset\sort` | Returns a new keyset sorted by the values of the given Traversable
`HH\Lib\Keyset\take` | Returns a new keyset containing the first `$n` elements of the given Traversable
`HH\Lib\Keyset\union` | Returns a new keyset containing all of the elements of the given Traversables

## Legacy Vector, Map, and Set

Early in Hack's life, the library provided mutable and immutable generic class types called: `Vector`, `ImmVector`, `Map`, `ImmMap`, `Set`,
and `ImmSet`. However, these have been replaced by `vec`, `dict`, and `keyset`, whose use is recommended in all new code. Each generic type
had a corresponding literal form. For example, a variable of type `vector<int>` might be initialized using `Vector {22, 33, $v}`, where `$v`
is a variable of type `int`.

## Legacy array

**`array` is a hold-over type from PHP. Due to some of the limitations of this type, Hack programmers are encouraged to use `vec`, `dict`,
and `keyset` instead.**

Within this section, the term *array* means *legacy array*.

Note: Legacy arrays are quite different to arrays in numerous mainstream languages. Specifically, legacy array elements need not have the
same type, the subscript index need not be an integer (so there is no concept of a base index of zero or one), and there is no concept of
consecutive elements occupying physically adjacent memory locations.

An array is a data structure that contains a collection of zero or more elements whose values are each accessed through a corresponding key.
As the number of elements in an array can change at runtime, an array type does *not* include an element count.  Consider the following class
property, which has an array type:

```Hack
private array<string> $colorsVect = array("red", "white", "blue");
```

This is a *vector-like* array, and it has an implicit key type of `int`, and an explicit value type of `string`.  This array is created
and initialized using the array-creation intrinsic function, `array(...)`.  (There is an equivalent array-creation operator `[...]`.)
There are three elements, and their corresponding keys are 0, 1, and 2.

An array's key type can be declared explicitly; for example:


```Hack
private array<int, string> $colorsMap = array("red", "white", "blue");
```

This is a *map-like* array, with an explicit key and value type.  As before, there are three elements, and their corresponding keys are 0, 1, and 2.

Note, carefully, that although `$colorsVect` and `$colorsMap` result in arrays of `int`/`string` pairs, they do *not* have the same (or
even compatible) types!

When we create a map-like array, we can specify the key values as well; for example:

```Hack
private array<int, string> $colorsMap
  = array(-10 => "white", 12 => "blue", 0 => "red");
```

Note how the key values do not start at 0, nor are they consecutive!

The key type can be other than `int`; for example:

```Hack
private array<string, int> $fruitMap = array('oranges' => 25, 'apples' => 12, 'pears' => 17);
```

Although we can use any type as an array's key type, behind the scenes, the key is actually represented as an `int` or `string`,
so&mdash;possibly surprising, or at least, unexpected&mdash;conversions occur when other key types are specified. **Programmers are strongly
advised to avoid using key types other than `int` or `string`.**

Each element in an array must have a value type that is the exact type indicated by the array declaration, or a
[subtype](../types/supertypes-and-subtypes.md) of that type. For example:

```Hack
private array<num> $numbers = array(5.4, 234);
private array<mixed> $misc = array(10, 'b', false);
```

The vector-like array `$numbers` has type `num` and contains a `float` and an `int`, respectively.  The vector-like array `$misc` has type `mixed`,
and contains an `int`, a `string`, and a `bool`, respectively.

An array element can have any type (which allows for arrays of arrays).  For example:

```Hack
private array<array<int>> $counts = array(array(10,20), array(2,3));
```

`$counts` is a vector-like array of two elements each of which is a vector-like array of two elements, each of which is an `int`.

An array is represented as an ordered map in which each entry is a key/value pair that represents an element. Duplicate keys are not permitted.
The order of the elements in the map is the order in which the elements were inserted into the array. An element is said to *exist* once it has
been inserted into the array with a corresponding key. An array is *extended* by initializing a previously non-existent element using a new key.

Elements can be removed from an array with `unset`.

The [`foreach` statement](../statements/foreach.md) can be used to iterate over the collection of elements in an array, in the order in
which the elements were inserted. This statement provides a way to access the key and value for each element.

The value (and possibly the type) of an existing element is obtained or changed, and new elements are inserted, using the
[subscript operator `[]`](../expressions-and-operators/subscript.md).  For example:

@@ arrays-examples/legacy-array-colors.php @@

@@ arrays-examples/legacy-array-fruits.php @@

Two arrays can be compared using [relational operators](../expressions-and-operators/relational.md) and
[equality operators](../expressions-and-operators/equality.md).

Numerous library functions are available that manipulate arrays.

## Migrating from legacy arrays

Two special types, `varray` and `darray`, currently exist to facilitate
migration from the legacy `array` type towards a more type-safe codebase (note
that both legacy `array` and these migration types are temporary, the plan is
for all of them to be removed from tha Hack language eventually).

While migrating straight to `vec` and `dict` would be preferable (and may be
possible for smaller projects), it is usually not possible without manual review
and testing of the changes. In contrast, `varray` and `darray` are designed to
be drop-in replacements for the `array` type, so an automated migration is
feasible.

In general, `array`, `varray` and `darray` can be used interchangeably at
runtime (which makes such automated migration safe), but they are recognized as
different types by the typechecker&mdash;resulting in a more type-safe codebase.
See below for a more detailed description.

### Usage

`varray` represents a &ldquo;vec-like array&rdquo; and must always be used with
a single generic type parameter (e.g. `varray<int>`, `varray<MyClass>`,
`varray<mixed>`). `darray` represents a &ldquo;dict-like array&rdquo; and must
be used with two generic type parameters, the first being a valid key type
(`int`, `string` or `arraykey`), e.g. `darray<string, MyClass>` or
`darray<arraykey, mixed>`.

Values can be initialized using literals:

```Hack
$numbers = varray[1, 1, 2, 3, 5, 8, 14];
$words = varray['foo', 'bar'];
$options = darray['yes' => 1, 'no' => 2];
```

Or from values of any other array-like types:

```Hack
$vee = varray($traversable);
$dee = darray($keyed_traversable);
```

(not to be confused with `array('foo', 'bar')`, where rounded brackets are used
for literal values)

### Runtime behavior

- At runtime, all `array`, `varray` and `darray` values are mutually compatible,
  so there is no risk of causing a breaking change by migrating between them.
- Note that this means that `varray` and `darray` preserve all quirks of legacy
  arrays (such as their &ldquo;magical&rdquo; conversions between key types).
  This is why migrating to `vec` and `dict` would be preferable, but is not
  backwards-compatible.
- The built-in function `\is_array()` returns `true` for all three types (again,
  preserving backwards-compatibility).

### Typechecker behavior

- As of HHVM 4.28, the typechecker treats `array<T>` (`array` with one generic
  type parameter) as an alias of `varray<T>`, and `array<Tk, Tv>` (with two
  generic type parameters) as an alias of `darray<Tk, Tv>`. This means that the
  typechecker output will always show `varray`/`darray` in error messages, even
  for code that uses `array`s.
- There is one additional special type, only recognized by the typechecker (does
  not exist at runtime): `array` with missing generic type parameters is
  considered a `varray_or_darray`, which is, roughly, treated as a supertype of
  both `varray` and `darray` (`varray`/`darray` can be used where
  `varray_or_darray` is expected but not vice-versa).
- `varray_or_darray` can be used as a typehint (for example, when an automated
  migration can't reliably determine whether `varray` or `darray` is correct),
  but there is no literal syntax.
- There is special handling for empty `array` literals (`array()` or `[]`) in
  the typechecker&mdash;generally, they're allowed everywhere any of the above
  types is used.
- Note that these rules don't apply to HHVM versions prior to 4.28. Previously,
  the typechecker recognized `array`, `varray`, `darray` and `varray_or_darray`
  as separate types that couldn't always be used interchangeably.

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
