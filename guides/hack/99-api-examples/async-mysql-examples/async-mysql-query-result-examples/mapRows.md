When executing a query, you can get the rows returned from it in the form of a `Vector` of `Map` objects, where each key of the `Map` is a column name. This example shows how to use `AsyncMysqlQueryResult::mapRows` to get that `Map`. A resulting `Map` may look like:

```
object(HH\Vector)#9 (2) {
  [0]=>
  object(HH\Map)#10 (1) {
    ["name"]=>
    string(11) "Joel Marcey"
  }
  [1]=>
  object(HH\Map)#11 (1) {
    ["name"]=>
    string(11) "Fred Emmott"
  }
}
```
