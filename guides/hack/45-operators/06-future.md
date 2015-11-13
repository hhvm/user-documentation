# Future Operators

Hack will be supporting new operators soon. 

## `??`` (null coalescing)

The binary null coalescing operator that returns the result of its first operand `A` if it exists and is not `null`; otherwise returns the second operand `B`.

```
// $x assigned to the value of $A if $A exists and not null
// otherwise $B
$x = $A ?? $B

// The equivalent mechanism to do this previously would be:
$x = isset($A) ? $A : $B;
```

## `<=>` (three-way comparison)

The three-way comparison operator (also know as the spaceship operator), determines, in one operation, whether `A` is less than, equal to or greater than `B`. This could be useful for sorting operations like `usort()`[http://php.net/manual/en/function.usort.php]

```
$A <=> $B // return 0 if equal, 1 if $A is greater, -1 if $B is greater
```
