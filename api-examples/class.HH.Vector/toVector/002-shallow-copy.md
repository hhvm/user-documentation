This example shows how `toVector()` returns a shallow copy of `$v` (a new `Vector` object containing the same elements)
rather than a deep copy (a new `Vector` object containing copies of the elements of `$v` that are themselves objects).

Thus, mutating an element of `$v` that is itself an object also mutates the corresponding element of `$v2`, since the element in `$v`
is the same object as the element in `$v2`.
