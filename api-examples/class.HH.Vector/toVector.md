This example shows how `toVector()` returns a copy of `$v` (a new `Vector` object), so mutating this new `Vector` doesn't affect the original.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Make a new Vector that is a copy of $v (i.e. contains the same elements)
$v2 = $v->toVector();

// Modify $v2 by adding an element
$v2->add('purple');
\var_dump($v2);

// The original Vector $v doesn't include 'purple'
\var_dump($v);
```

This example shows how `toVector()` returns a shallow copy of `$v` (a new `Vector` object containing the same elements)
rather than a deep copy (a new `Vector` object containing copies of the elements of `$v` that are themselves objects).

Thus, mutating an element of `$v` that is itself an object also mutates the corresponding element of `$v2`, since the element in `$v`
is the same object as the element in `$v2`.

```shallow-copy.php
$inner = Vector {1, 2, 3};
$v = Vector {Vector {'a'}, $inner, Vector {'c'}};

// Make a Vector copy of $v
$v2 = $v->toVector();

// Modify the original Vector $v's inner Vector by adding an element
$v[1]->add(4);

// The original Vector $v's inner Vector includes 4.
\var_dump($v);

// The new Vector $v2's inner Vector also includes 4. toVector() only does a shallow copy.
\var_dump($v2);
```
