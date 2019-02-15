Suppose we wish to have a function return multiple values. We can do that by using a tuple containing two, three, four, or more elements. A 
tuple is an *ordered* set of two or more elements, which can have different types.  The number of elements in a particular tuple is fixed 
when that tuple is created.  After a tuple has been created, no elements can be added or removed, and the type of an existing element cannot 
be changed. However, the value of any element can be changed. 

Consider the case in which we want to have a pair of related values, one a string, the other an integer. For example:

```Hack
$v = tuple("apples", 25);
function process_pair((string, int)): void { ... }
function get_next_pair(): (string, int) { ... }
```

A tuple value has the form of a comma-separated list of values delimited with parentheses and preceded by `tuple`, as in `tuple("apples", 25)` 
above.  As we can quickly deduce, that tuple has type *tuple of two elements, in the order `string` and `int`*, and that is the type of the 
argument expected by function `process_pair`, and returned by function `get_next_pair`.

Note carefully that the tuple values `tuple("apples", 25)` and `tuple(25, "apples")` have *different and incompatible* types! Of course, 
`tuple("apples", 25)` and `tuple("peaches", 33)` have the same type. [Indeed, `tuple("horses", 3)` has the same type as well; there is nothing 
fruit- or animal-specific about this tuple type.]

A tuple can be indexed with the subscript operator (`[]`); however, the index value must be an integer constant whose value is in the range of 
element indices. The index of the first element is zero, with subsequent elements having index values one more than their predecessor:

```Hack
$t = tuple(10, true, 2.3);
echo "\$t[2] = >" . $t[2] . "<";  // outputs "$t[2] = >2.3<"
$t[0] = 99;                       // change 10 to 99
```

Here is a more exotic example of a type involve a tuple:

```Hack
?(int, (string, float))
```

This declares a nullable type for a tuple containing an `int` and a tuple, which in turn, contains a `string` and a `float`.

For non-trivial tuple types, it can be cumbersome to write out the complete type. Fortunately, Hack provides a type-aliasing capability via 
`newtype` (and `type`).  For example:

@@ tuples-examples/distance-between-Points.php @@

