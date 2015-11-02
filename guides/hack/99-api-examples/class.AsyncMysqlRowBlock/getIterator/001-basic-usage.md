The following example shows you how to get an iterator of an `AsyncMysqlRowBlock` via `getIterator()`. Getting an iterator of an `AsyncMysqlRowBlock` gives you an `AsyncMysqlRowBlockIterator`, where each key of that iterator is an `int` representing the key to an `AsyncMysqlRow` of that row block, and each value from `current()` is the actual `AsyncMysqlRow`.

And then you can perform operations on that `AsyncMysqlRow`, including get an iterator of that as well.
