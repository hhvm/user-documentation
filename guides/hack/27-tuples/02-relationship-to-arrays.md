Under the covers, in [HHVM](/hhvm/), tuples are really just restricted arrays.

## Elements

You cannot change a tuple's number of elements. You *can* change a value of a tuple. Prior to 3.27, it was required that elements retain the same type.

## Reading

You can read from a tuple using [array square bracket syntax](http://php.net/manual/en/language.types.array.php). The most common way to read from a tuple, however, is to use [`list()`](http://php.net/manual/en/function.list.php) assignment.

@@ relationship-to-arrays-examples/reading.php @@
