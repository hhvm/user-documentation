## Array internal cursors

Under PHP5, if an array's internal cursor points to the position past the last element and then a copy of the array is made, the copy will have its internal cursor reset to point at the first element. Under HHVM, when a copy of an array is made, the copy's internal cursor will always point to the same position that the original array's internal cursor pointed to.

@@ arrays-and-foreach-examples/array-internal-cursors.php @@

Difference: [https://3v4l.org/QOOGA](https://3v4l.org/QOOGA)

## Foreach by value

Under PHP5, `foreach` by value will modify the array's internal cursor under certain circumstances. Under HHVM, `foreach` by value will never modify the array's internal cursor.

## Foreach by reference

Under PHP5, the behavior of a `foreach` by reference loop can be unpredictable if during iteration the next element of the array is unset, or if the array variable is assigned to directly or through a reference, or if copy-on-write causes the array to be copied. For such cases, HHVM's behavior may differ from PHP5.
