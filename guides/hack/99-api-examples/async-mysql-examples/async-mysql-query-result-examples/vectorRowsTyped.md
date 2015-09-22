When executing a query, you can get the rows returned from it in the form of a `Vector` of `Vector` objects, where each value of the `Vector` is a column value. This example shows how to use `AsyncMysqlQueryResult::vectorRowsTyped` to get that `Vector`. A resulting `Vector` may look like:

```
object(HH\Vector)#9 (2) {
  [0]=>
  object(HH\Vector)#10 (2) {
    [0]=>
    string(11) "Joel Marcey"
    [1]=>
    int(41)
  }
  [1]=>
  object(HH\Vector)#11 (2) {
    [0]=>
    string(11) "Fred Emmott"
    [1]=>
    int(26)
  }
}
```

Note that all values in the `Vector` returned from `vectorRowsTyped` will be the actual typed representation of the database type, or `null`. Above you can see we have `string` and `int`. If you want just `string` values for everything, use `vectorRows`

Also understand that if you want the actual column names associated with the values in the `Vector`, you should use `mapRowsTyped` instead.
