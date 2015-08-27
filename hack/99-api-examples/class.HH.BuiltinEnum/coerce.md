This example shows how `coerce()` can be used to get the `Day` enum member value given a value of its underlying type `int`. Since `coerce()` returns `null` if the given `int` is not a member value of the enum `Day`, we just return `null` from `get_next_day_int()` if it can't be found.
 
