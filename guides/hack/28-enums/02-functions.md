Enums are scalar types, but they act like objects in a couple of ways. First, they are namespaceable. Secondly, you access enum member values like you do class constants. Thirdly, there are 6 static functions available to every enum.

## `assert()`

`assert()` takes a value, tries to cast it to the underlying enum type. If it can, it returns the casted value (e.g., the type of which is the enum name); otherwise it will throw an `UnexpectedValueException`.

@@ functions-examples/assert.php @@

This example shows how `assert()` can be used to get the `Day` enum member value given a value of its underlying type `int`. Since there is a check making sure the provided `int` is in the proper range, we can be confident that we won't get a runtime exception for using a value that doesn't exist in the enum.

## `assertAll()`

`assertAll()` takes a container of values, tries to cast each one to the underlying enum type. If it can for *all values*, it returns a container of casted values; otherwise it will throw an `UnexpectedValueException`.

@@ functions-examples/assertAll.php @@

This example shows how `assertAll()` can be used to get the `Day` enum member values given a `Vector` of its underlying type `int`. Since there is a check making sure the provided `int`s in the `Vector` are in the proper range, we can be confident that we won't get a runtime exception for using a value that doesn't exist in the enum.

Note that `assertAll()` returns a `Container` (which is a child of `Traversable`, so in order we need to create a new `Vector` from that `Container` and pass it to `get_latest_day()`. 

## `coerce()`

Similar to `assert()`, but instead of throwing an exception when the cast cannot happen, it returns `null`.

@@ functions-examples/coerce.php @@

This example shows how `coerce()` can be used to get the `Day` enum member value given a value of its underlying type `int`. Since `coerce()` returns `null` if the given `int` is not a member value of the enum `Day`, we just return `null` from `get_next_day_int()` if it can't be found.

## `getNames()`

`getNames()` returns an `array` mapping the enum member values to their names. An `InvariantException` is thrown if the enum values are not unique.

@@ functions-examples/getNames.php @@

This example shows how you can use `getNames()` to get the names of the `Day` enum (e.g., "SUNDAY") and check that `array` against a provided name to determine existence.

## `getValues()`

`getValues()` returns an `array` mapping the enum member names to their values.

@@ functions-examples/getValues.php @@

This example simply shows the format of what a call to `getValues()` would output on the `Day` enum.

## `isValid()`

`isValid` takes a value and returns a `bool` depending on whether that value exists in the enum.

@@ functions-examples/isValid.php @@

This example shows how `isValid()` can be used to determine whether a given underlying value of the `Day` enum type (in this case `int`) is a member value of `Day`.
