``` yamlmeta
{
    "name": "mapRows",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns the actual rows returned by the successful query, each row
including the name and value for each column




``` Hack
public function mapRows(): Vector<Map<string, ?string>>;
```




All values come back as ` string `s. If you want typed values, use
`` mapRowsTyped() ``.




The rows are returned as a ` Vector ` of `` Map `` objects. The ``` Map ``` objects map
column names to (possibly ```` null ````) ````` string ````` values.




## Returns




+ ` Vector<Map<string, ?string>> ` - A `` Vector `` of ``` Map ``` objects, where the ```` Vector ```` elements are the
  rows and the ````` Map ````` elements are the column names and values
  associated with that row.




## Examples




When executing a query, you can get the rows returned from it in the form of a ` Vector ` of `` Map `` objects, where each key of the ``` Map ``` is a column name. This example shows how to use ```` AsyncMysqlQueryResult::mapRows ```` to get that ````` Map `````. A resulting `````` Map `````` may look like:




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




Note that all values in the ` Map ` returned from `` mapRows `` will be ``` string ``` or ```` null ````. If you want specifically-typed values, use ````` mapRowsTyped `````







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/mapRows/001-basic-usage.php @@
<!-- HHAPIDOC -->
