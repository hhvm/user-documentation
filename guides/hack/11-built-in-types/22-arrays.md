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

## Nomenclature

When talking about Container types, Hack programmers have names for different categories of types. They overlap and are confusing to the uninitiated. Here are some of the most common terms.

`Arrays`: When not prefixed with any modifiers or other context usually refers to the value Containers. The value Containers are

 - The (Legacy) PHP `array`
 - `darray` and `varray`
 - `dict`, `keyset`, and `vec`

`Hack arrays`: This specifically refers to the last three (`dict`, `keyset`, and `vec`).

`Hack Collections` or `Legacy Hack Collections`: This refers to the non-value type Containers from Hack's early life. The Hack Collection types are:

 - `ConstMap`, `MutableMap`, `ImmMap`, and `Map`
 - `ConstSet`, `MutableSet`, `ImmSet`, and `Set`
 - `ConstVector`, `MutableVector`, `ImmVector`, and `Vector`
 - `Pair`

 The `Const?` and `Mutable?` are interfaces. The `Imm?` implements `Const` and the unprefixed version implements both.

`Hack Containers`: This is a combination of the `Hack arrays` and `Hack collections`.

`Value Containers`: See arrays.

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

```vec-colors.php
$colors = vec[]; // create an empty vec
\var_dump($colors);

$colors[] = "red"; // add element 0 with value "red"
$colors[] = "white"; // add element 1 with value "white"
$colors[] = "blue"; // add element 2 with value "blue"
\var_dump($colors);

$colors[0] = "pink"; // change element 0's value to "pink"
\var_dump($colors);

$colors = vec["green", "yellow"]; // create a vec of two elements
\var_dump($colors);
```

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

Note, carefully, that although `$colorsVec` and `$colorsDict` result in collections of `int`/`string` pairs, these variables do *not* have the
same (or even compatible) types! That said, there are library functions to convert between vec and dict objects.

Consider the following:

```dict-colors.php
$colors = dict[]; // create an empty dict
\var_dump($colors);

$colors[4] = "black"; // create element 4 with value "black"
\var_dump($colors);

$colors[4] = "red"; // replace element 4's value with "red"
$colors[8] = "white"; // create element 8 with value "white"
$colors[-3] = "blue"; // create element -3 with value "blue"
\var_dump($colors);

$colors = dict[
  -10 => "white",
  12 => "blue",
  0 => "red",
]; // create a dict with 3 elements
\var_dump($colors);
```

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
type `int` or `string`, keysets are restricted to homogeneous collections of
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

```keyset-colors.php
$colors = keyset[]; // create an empty keyset
\var_dump($colors);

$colors[] = "red"; // add element with key/value "red"
$colors[] = "white"; // add element with key/value "white"
$colors[] = "blue"; // add element with key/value "blue"
\var_dump($colors);

$colors = keyset[
  "green",
  "yellow",
  "green",
]; // create a keyset of two elements
\var_dump($colors);

echo "\$colors[\"green\"] = ".$colors["green"]."\n";
```

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
| Remove Elements           | `$v = Vec\concat(Vec\take($t1, $n), Vec\drop($t1, $n + 1))` | `unset($d['baz']);` | `unset($k['baz']);`
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

In HHVM version 4.62 and earlier, by default, `varray` and `darray` are interchangeable at runtime; this can be changed, as can some legacy PHP array behaviors, depending on the HHVM version.

The available runtime options change frequently; to get an up-to-date list, search `ini_get_all()` for settings beginning with `hhvm.hack_arr`; in general:
- a value of `0` means no logging
- `1` means a warning or notice is raised
- `2` means a recoverable error is raised

The `hhvm.hack_arr_compat_notices` option must be set to true for any of the `hhvm.hack_arr_` options to have an effect.

Individual runtime settings are documented [here](darray-varray-runtime-options.md).

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

## Value vs. reference semantics

An important distinction between `arrays` and `Collections` is their interaction with value semantics.
All `arrays` (recognizable by their lowercase names) have value semantics.
All `Collections` (recognizable by their uppercase names) have reference semantics.

### What are reference semantics (disambiguation)

`Reference semantics` does **NOT** refer to the deprecated `&$references`.
It addresses how an instance behaves when assigned / passed into or returned from functions.
An object has reference semantics.
If I pass you a `Person` instance and you set the last name to `"Doe"`, I'll be able to observe that change on my instance (`$emma`).

```reference-semantics.php
<<__EntryPoint>>
function main(): void {
  $john = new Person('John', 'Doe');
  $emma = new Person('Emma', 'Smith');

  echo Str\format(
    "%s's last name was %s before she got married.\n",
    $emma->firstName,
    $emma->lastName,
  );

  marry($john, $emma);

  echo Str\format(
    "%s's last name became %s after she got married.\n",
    $emma->firstName,
    $emma->lastName,
  );
}

function marry(Person $a, Person $b): void {
  $b->lastName = $a->lastName;
}

class Person {
  public function __construct(
    public string $firstName,
    public string $lastName,
  ) {}
}
```

However, if you were to do the same with an array type, you'd not observe the changes in your variable (`$emma`).

```dicts-have-value-semantics.php
<<__EntryPoint>>
function main(): void {
  $john = make_person('John', 'Doe');
  $emma = make_person('Emma', 'Smith');

  echo Str\format(
    "%s's last name was %s before she got married.\n",
    $emma['first'],
    $emma['last'],
  );

  marry($john, $emma);

  echo Str\format(
    "%s's last name is still %s after she got married.\n",
    $emma['first'],
    $emma['last'],
  );
}

/**
 * This function is now not doing anything,
 * since the modifications are function local.
 */
function marry(dict<string, string> $a, dict<string, string> $b): void {
  $b['last'] = $a['last'];
}

function make_person(
  string $first_name,
  string $last_name,
): dict<string, string> {
  return dict[
    'first' => $first_name,
    'last' => $last_name,
  ];
}
```

If you want to modify a value type parameter, see `inout`.
This will _copy out_ the changes made in `marry()` when the function finishes.

Watch out! Collections have reference semantics!

```maps-have-reference-semantics.php
<<__EntryPoint>>
function main(): void {
  $john = make_person('John', 'Doe');
  $emma = make_person('Emma', 'Smith');

  echo Str\format(
    "%s's last name was %s before she got married.\n",
    $emma['first'],
    $emma['last'],
  );

  marry($john, $emma);

  echo Str\format(
    "%s's last name is now %s after she got married.\n",
    $emma['first'],
    $emma['last'],
  );
}

/**
 * I modify $b and you'll be able to observe these changes in your $emma.
 */
function marry(Map<string, string> $a, Map<string, string> $b): void {
  $b['last'] = $a['last'];
}

function make_person(
  string $first_name,
  string $last_name,
): Map<string, string> {
  return Map {
    'first' => $first_name,
    'last' => $last_name,
  };
}
```

This difference makes it very difficult to migrate from Containers to arrays.
It is recommended to not share a mutable reference to a Collection across a codebase.
If this is required for the correctness of your program, but you are migrating to Hack arrays, you can use `HH\Lib\Ref<T>`.
Pass a `Ref<dict<string, string>>` around your program instead of a `Map<string, string>`.
This makes it obvious that you intend to mutate the dict.

### When do two value Containers become separate things?

From the perspective of the programmer, as soon as you give the value a (new) name.

```assignment-with-value-containers.php
$emma = dict['first' => 'Emma', 'last' => 'Smith'];
$another_emma = $emma;

echo Str\format("$%s's last name is %s.\n", 'emma', $emma['last']);

$emma['last'] = 'Doe';

echo Str\format(
  "$%s's last name has been changed to %s.\n",
  'emma',
  $emma['last'],
);

echo Str\format(
  "$%s's last name has not been changed and is still %s.\n",
  'another_emma',
  $another_emma['last'],
);
```

Within the assignment `$another_emma = $emma`, a logical copy was made.
From the programmer's perspective, you now have two copies of the emma dict.
The hhvm engine is free to defer this copy at runtime until changes would be observable.
If you'd never change any elements of `$emma`, `$another_emma` could point to the same memory as `$emma`.
This saves memory and time.

However, when you modify `$emma`, `$another_emma` **MUST NOT** reflect these changes.
This optimization is called Copy on Write or `CoW` for short.
This is also why you'll sometimes hear that arrays have copy-on-write semantics.
This is however an implementation detail.
HHVM _could_ just make a copy every time a logical copy is made and be correct.
