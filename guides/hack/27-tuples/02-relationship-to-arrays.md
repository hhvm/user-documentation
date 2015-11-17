Under the covers, in [HHVM](/hhvm/), tuples are really just restricted arrays. 

## Elements

You cannot change a tuple's number of elements. You *can* change a value of a tuple **if and only if** the new value is of the *same type* as the current value.

If you try to change a value to a value of a different type, [the Hack typechecker](hack/typechecker/introduction) will raise an error (however, HHVM will run without complaint since tuples are just arrays under the covers).

@@ relationship-to-arrays-examples/change-value.php.type-errors @@

## Reading

You can read from a tuple using [array square bracket syntax](http://php.net/manual/en/language.types.array.php). The most common way to read from a tuple, however, is to use [`list()`](http://php.net/manual/en/function.list.php) assignment.  

@@ relationship-to-arrays-examples/reading.php @@
