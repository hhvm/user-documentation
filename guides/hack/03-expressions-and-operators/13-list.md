`list()` is special syntax for unpacking tuples. It looks like a function, but it isn't one. It can be used in positions that you would assign into.

@@ list-examples/basic-tuple-assignment.php @@

The `list()` will consume the `tuple` on the right and assign the variables inside of itself in turn.
If the types of the tuple elements differ, the `list()` syntax will make sure that the type information is preserved.

@@ list-examples/typed-tuple-assignment.php @@

You can use the special `$_` variable to ignore certain elements of the `tuple`. You can use `$_` multiple times in one assignment and have the types be different. You **MUST** use `$_` if you want to ignore the elements at the end. You are not allowed to use a `list()` with fewer elements than the length of the `tuple`.

@@ list-examples/ignored-tuple-assignment.php @@

If the RHS and the LHS of a `list()` are referring to the same variables, the behavior is undefined. As of hhvm 4.46, the typechecker will **NOT** warn you when you make this mistake! HHVM will also not understand what you mean. Do **NOT** do this.

```Hack
$a = tuple(1, 2);
// BAD, since $a is used on the right and on the left!
list($a, $b) = $a;
```

You may also use `list()` on a `vec<T>`, but it is not recommended.

`list()` can be nested inside of another `list()` to unpack `tuples` from within `tuples`.

@@ list-examples/list-within-list.php @@

My personal favorite place to put a `list()` is inside a `foreach($vec_of_tuples as list($one, $two, $three))`.

@@ list-examples/list-within-foreach.php @@
