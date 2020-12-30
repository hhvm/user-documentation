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
