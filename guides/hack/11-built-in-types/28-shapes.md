A *shape* consists of a group of zero or more data fields taken together as a whole. A shape type is an *unordered* set of fields each
of which has a name and an associated type.  For example:

```Hack
$point1 = shape('x' => -3, 'y' => 6);
function set_origin(shape('x' => int, 'y' => int) $p): void { ... }
function get_origin(): shape('x' => int, 'y' => int) { ... }
```

Here, we mimic a point with integer coordinates, by having a shape with two fields called `x` and `y`, each of which is an `int`. A shape
value has the form of a comma-separated list of name/value pairs delimited with parentheses and preceded by `shape`, as in
`shape('x' => -3, 'y' => 6)` above.  As we can quickly deduce, that shape has type *shape of two fields, both of type `int`,
in some unknown order*, and that is the type of the argument expected by function `set_origin`, and returned by function `get_origin`.

As the ordering of the fields is irrelevant, given the following:

```Hack
shape('x' => -3, 'y' => 6)
shape('y' => 6, 'x' => -3)
```

the two shape values are identical.

A field in a shape is accessed using its name as the key in a subscript expression.  For example:

```Hack
function point_to_string(shape('x' => int, 'y' => int) $p): string {
  return '(' . $p['x'] . ',' . $p['y'] . ')';
}
$point1 = shape('x' => -3, 'y' => 6);
$s = point_to_string($point1);    // $s takes on the value "(-3,6)"
```

A field whose name is preceded by `?` is optional, and need not be mentioned in any initializer of, or assignment to, a variable of that type;
however, until its value is set explicitly, that field does not actually exist in the shape. Consider the following:

```Hack
function f(shape('a' => int, ?'n' => string) $p): void {
  echo "\$p['a']: " . $p['a'] . "\n";
  echo "\$p['n']: " . $p['n'] . "\n";  // only permitted if n exists
}
```

Given the call `f(shape('a' => 10, 'n' => "xxx"))`, field `n` has its value set explicitly, and `f` works fine. However, given the
call `f(shape('a' => 10))`, field `n` does not have its value set explicitly, in which case, attempting to access that field using `$p['n']`
results in an "undefined index" error at runtime. To be certain such accesses succeed, first call `Shapes::keyExists`. (See the library class
[`Shapes`](https://docs.hhvm.com/hack/shapes/functions).)

Here are some more, simple, shape-type examples:

```Hack
shape('real' => float, 'imag' => float)
shape('id' => string, 'url' => string, 'count' => int)
shape('name' => string, 'address' => shape('street' => string,
  'city' => string, 'state' => string, 'postcode' => int))
```

In the final case above, we have a shape within a shape.

Consider a shape type *S2* whose field set is a superset of that in shape type *S1*. As such, *S2* is a subtype of *S1*. (See the banking example
below.) However, when an *S2* is used as an *S1*, only the *S1* fields in that *S2* are accessible.

For non-trivial shape types (like the name and address one above), it can be cumbersome to write out the complete type. Fortunately, Hack provides
a type-aliasing capability via `type` (and `newtype`), which is demonstrated in the next example:

@@ shapes-examples/banking.php @@

Type `Transaction` is a sort-of abstract type that only ever contains the transaction-type field. The `...` notation indicates that there
may be other, optional fields. This allows the types `Deposit`, `Withdrawal`, and `Transfer` to be considered subtypes of `Transaction` by having
the same first field, and then adding other fields as well.

Note carefully, that inside function `process_transaction`, even though the transaction passed in might have been a `Deposit`, a `Withdrawal`,
or a `Transfer`, it always appears as a `Transaction`, so the only field we can access in `$t` is `trtype`. However, using `Shapes::toArray`,
we can convert the `Transaction` to an array, and then get read-access to the field values we know that array must contain by indexing it using
the field names, as shown.
