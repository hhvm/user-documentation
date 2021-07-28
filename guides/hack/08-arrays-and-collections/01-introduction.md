Hack includes diverse range of array-like data structures.

Hack arrays are value types for storing iterable data. The types
available are `vec`, `dict` and `keyset`. **When in doubt, use Hack
arrays**.

Collections are object types for storing iterable data. The types
available include `Vector`, `Map`, `Set`, `Pair` and helper
interfaces.

PHP arrays are legacy value types for storing iterable data. The types
available are `varray`, `darray` and `varray_or_darray`.

## Quickstart

You can create Hack arrays as follows:

```Hack
$v = vec[2, 1, 2];

$k = keyset[2, 1];

$d = dict['a' => 1, 'b' => 3];
```

There are many helpful functions in the `C`, `Vec`, `Keyset` and `Dict`
namespaces.

```Hack
// The C namespace contains generic functions that are relevant to
// all array and collection types.
C\count(vec[]); // 0
C\is_empty(keyset[]); // true

// The Vec, Keyset and Dict namespaces group functions according
// to their return type.
Vec\keys(dict['x' => 1]); // vec['x']
Keyset\keys(dict['x' => 1]); // keyset['x']

Vec\map(keyset[1, 2], $x ==> $x + 1); // vec[2, 3]
```

## Arrays Cheatsheet

| Operation| `vec`    | `dict`   | `keyset` |
|----------|----------|----------|----------|
| Initialize empty                             | `$v = vec[];`                | `$d = dict[];`                 | `$k = keyset[];`               |
| Literal                                      | `$v = vec[1, 2, 3];`         | `$d = dict['foo' => 1];`       | `$k = keyset['foo', 'bar'];`   |
| From Another Container*                      | `$v = vec($container);`      | `$d = dict($keyed_container);` | `$k = keyset($container);`     |
| Keys from Container*                         | `$v = Vec\keys($container);` | N/A                            | `$k = Keyset\keys($container);`|
| Add Elements                                 | `$v[] = 4;`                  | `$d['baz'] = 2;`               | `$k[] = 'baz';`                |
| Bulk Add Elements                            | `$v = Vec\concat($t1, $t2)`  | `$d = Dict\merge($kt1, $kt2)`  | `$k = Keyset\union($t1, $t2)`  |
| Remove Elements                              | Remove-at-index is unsupported; `$first = PHP\array_shift($v)` and `$last = PHP\array_pop($v)` | `unset($d['baz']);`| `unset($k['baz']);`|
| Key Existence                                | `C\contains_key($v, 1)`      | `C\contains_key($d, 'foo')`    | `C\contains_key($k, 'foo')`    |
| Value Existence                              | `C\contains($v, 3)`          | `C\contains($d, 2)`            | N/A                            |
| Equality (Order-Dependent)                   | `$v1 === $v2`                | `$d1 === $d2`                  | `$k1 === $k2`                  |
| Equality (Order-Independent)                 | N/A                          | `Dict\equal($d1, $d2)`         | `Keyset\equal($k1, $k2)`       |
| Count Elements (i.e., length, size of array) | `C\count($v)`                | `C\count($d)`                  | `C\count($k)`                  |
| Type Signature                               | `vec<Tv>`                    | `dict<Tk, Tv>`                 | `keyset<Tk>`                   |
| Type Refinement                              | `$v is vec<_>`               | `$d is dict<_, _>`             | `$k is keyset<_>`              |
| `Awaitable` Consolidation                    | `Vec\gen($v)`                | `Dict\gen($d)`                 | `Keyset\gen($x)`               |
