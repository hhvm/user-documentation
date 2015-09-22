When executing a query, you can get the rows returned from it in the form of a `Vector` of `Map` objects, where each key of the `Map` is a column name. This example shows how to use `AsyncMysqlQueryResult::mapRowsTyped` to get that `Map`. A resulting `Map` may look like:

```
object(HH\Vector)#9 (2) {
  [0]=>
  object(HH\Map)#10 (2) {
    ["name"]=>
    string(11) "Joel Marcey"
    ["age"]=>
    int(41)
  }
  [1]=>
  object(HH\Map)#11 (2) {
    ["name"]=>
    string(11) "Fred Emmott"
    ["age"]=>
    int(26)
  }
}
```

Note that all values in the `Map` returned from `mapRowsTyped` will be the actual typed representation of the database type, or `null`. Above you can see we have `string` and `int`. If you want just `string` values for everything, use `mapRows`
