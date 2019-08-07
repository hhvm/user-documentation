``` yamlmeta
{
    "name": "mapRowsTyped",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns the actual rows returned by the successful query, each row
including the name and typed-value for each column




``` Hack
public function mapRowsTyped(): Vector<Map<string, mixed>>;
```




The rows are returned as a ` Vector ` of `` Map `` objects. The ``` Map ``` objects map
column names to (possibly ```` null ````) ````` mixed ````` values (e.g., an `````` INTEGER `````` column
will come back as an ``````` int ```````.)




## Returns




+ ` Vector<Map<string, mixed>> ` - A `` Vector `` of ``` Map ``` objects, where the ```` Vector ```` elements are the
  rows and the ````` Map ````` elements are the column names and typed values
  associated with that row.




## Examples




When executing a query, you can get the rows returned from it in the form of a ` Vector ` of `` Map `` objects, where each key of the ``` Map ``` is a column name. This example shows how to use ```` AsyncMysqlQueryResult::mapRowsTyped ```` to get that ````` Map `````. A resulting `````` Map `````` may look like:




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




Note that all values in the ` Map ` returned from `` mapRowsTyped `` will be the actual typed representation of the database type, or ``` null ```. Above you can see we have ```` string ```` and ````` int `````. If you want just `````` string `````` values for everything, use ``````` mapRows ```````







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/mapRowsTyped/001-basic-usage.php @@
<!-- HHAPIDOC -->
