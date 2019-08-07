``` yamlmeta
{
    "name": "vectorRows",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns the actual rows returned by the successful query, each row
including the values for each column




``` Hack
public function vectorRows(): Vector<KeyedContainer<int, ?string>>;
```




All values come back as ` string `s. If you want typed values, use
`` vectorRowsTyped() ``.




The rows are returned as a ` Vector ` of `` Vector `` objects which hold the
(possibly ``` null ```) ```` string ```` values of each column in the order of the
original query.




## Returns




+ ` Vector<KeyedContainer<int, ?string>> ` - A `` Vector `` of ``` Vector ``` objects, where the outer ```` Vector ````
  represents the rows and each inner ````` Vector ````` represent the
  column values for each row.




## Examples




When executing a query, you can get the rows returned from it in the form of a ` Vector ` of `` Vector `` objects, where each value of the ``` Vector ``` is a column value. This example shows how to use ```` AsyncMysqlQueryResult::vectorRows ```` to get that ````` Vector `````. A resulting `````` Vector `````` may look like:




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




Note that all values in the ` Vector ` returned from `` vectorRows `` will be ``` string ``` or ```` null ````. If you want specifically-typed values, use ````` vectorRowsTyped `````.




Also understand that if you want the actual column names associated with the values in the ` Vector `, you should use `` mapRows `` instead.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/vectorRows/001-basic-usage.php @@
<!-- HHAPIDOC -->
