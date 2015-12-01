The following example shows how a call to `AsyncMysqlQueryResult::rowBlocks` gets you a `Vector` of `AsyncMysqlRowBlock` objects. Each object can then be queried for statistical data on that row, such as the number of fields that came back with the result, etc.

**NOTE**: A call to `rowBlocks()` actually pops the first element of that `Vector`. So, for example, if you have the following:

```
object(HH\Vector)#9 (1) {
  [0]=>
  object(AsyncMysqlRowBlock)#10 (0) {
  }
}
```

a call to `rowBlocks()` will make it so that you know have:

```
object(HH\Vector)#9 (0) {
}
```

and thus a subsequent call to `rowBlocks()` will return an empty `Vector`.
