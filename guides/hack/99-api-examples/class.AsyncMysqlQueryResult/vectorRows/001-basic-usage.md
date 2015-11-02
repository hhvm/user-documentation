When executing a query, you can get the rows returned from it in the form of a `Vector` of `Vector` objects, where each value of the `Vector` is a column value. This example shows how to use `AsyncMysqlQueryResult::vectorRows` to get that `Vector`. A resulting `Vector` may look like:

```
object(HH\Vector)#9 (2) {
  [0]=>
  object(HH\Vector)#10 (1) {
    [0]=>
    string(11) "Joel Marcey"
  }
  [1]=>
  object(HH\Vector)#11 (1) {
    [0]=>
    string(11) "Fred Emmott"
  }
}
```

Note that all values in the `Vector` returned from `vectorRows` will be `string` or `null`. If you want specifically-typed values, use `vectorRowsTyped`.

Also understand that if you want the actual column names associated with the values in the `Vector`, you should use `mapRows` instead.
