This example shows how `assertAll()` can be used to get the `Day` enum member values given a `Vector` of its underlying type `int`. Since there is a check making sure the provided `int`s in the `Vector` are in the proper range, we can be confident that we won't get a runtime exception for using a value that doesn't exist in the enum.

Note that `assertAll()` returns a `Container` (which is a child of `Traversable`, so in order we need to create a new `Vector` from that `Container` and pass it to `get_lastest_day()`. 
