``` yamlmeta
{
    "name": "vectorRowsTyped",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns the actual rows returned by the successful query, each row
including the typed values for each column




``` Hack
public function vectorRowsTyped(): Vector<KeyedContainer<int, mixed>>;
```




The rows are returned as a ` Vector ` of `` Vector `` objects which hold the
(possibly ``` null ```) ```` mixed ```` values of each column in the order of the
original query (e.g., an ````` INTEGER ````` column will come back as an `````` int ``````.).




## Returns




+ ` Vector<KeyedContainer<int, mixed>> ` - A `` Vector `` of ``` Vector ``` objects, where the outer ```` Vector ````
  represents the rows and each inner ````` Vector ````` represent the typed
  column values for each row.




## Examples




When executing a query, you can get the rows returned from it in the form of a ` Vector ` of `` Vector `` objects, where each value of the ``` Vector ``` is a column value. This example shows how to use ```` AsyncMysqlQueryResult::vectorRowsTyped ```` to get that ````` Vector `````. A resulting `````` Vector `````` may look like:




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




Note that all values in the ` Vector ` returned from `` vectorRowsTyped `` will be the actual typed representation of the database type, or ``` null ```. Above you can see we have ```` string ```` and ````` int `````. If you want just `````` string `````` values for everything, use ``````` vectorRows ```````




Also understand that if you want the actual column names associated with the values in the ` Vector `, you should use `` mapRowsTyped `` instead.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/vectorRowsTyped/001-basic-usage.php @@
<!-- HHAPIDOC -->
