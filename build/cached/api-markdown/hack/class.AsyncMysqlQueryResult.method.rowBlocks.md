``` yamlmeta
{
    "name": "rowBlocks",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns a ` Vector ` representing all row blocks returned by the successful
query




``` Hack
public function rowBlocks(): Vector<AsyncMysqlRowBlock>;
```




A row block can be the full result of the query (if there is only one
row block), or it can be the partial result of the query (if there are
more than one row block). The total number of row blocks makes up the
entire result of the successful query.




Usually, there will be only one row block in the vector because the
query completed in full in one attempt. However, if, for example, the
query represented something that exceeded some network parameter, the
result could come back in multiple blocks.




## Returns




+ ` Vector<AsyncMysqlRowBlock> ` - A `` Vector `` of ``` AsyncMysqlRowBlock ``` objects, the total number
  of which represent the full result of the query.




## Examples




The following example shows how a call to ` AsyncMysqlQueryResult::rowBlocks ` gets you a `` Vector `` of ``` AsyncMysqlRowBlock ``` objects. Each object can then be queried for statistical data on that row, such as the number of fields that came back with the result, etc.




**NOTE**: A call to ` rowBlocks() ` actually pops the first element of that `` Vector ``. So, for example, if you have the following:




```
object(HH\Vector)#9 (1) {
  [0]=>
  object(AsyncMysqlRowBlock)#10 (0) {
  }
}
```




a call to ` rowBlocks() ` will make it so that you know have:




```
object(HH\Vector)#9 (0) {
}
```




and thus a subsequent call to ` rowBlocks() ` will return an empty `` Vector ``.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/rowBlocks/001-basic-usage.php @@
<!-- HHAPIDOC -->
