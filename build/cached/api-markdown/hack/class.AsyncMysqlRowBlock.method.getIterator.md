``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Get the iterator for the rows in the block




``` Hack
public function getIterator(): AsyncMysqlRowBlockIterator<int, AsyncMysqlRow>;
```




## Returns




+ ` AsyncMysqlRowBlockIterator<int, AsyncMysqlRow> ` - An `` AsyncMysqlRowBlockIterator `` to iterate over the current
  row block.




## Examples




The following example shows you how to get an iterator of an ` AsyncMysqlRowBlock ` via `` getIterator() ``. Getting an iterator of an ``` AsyncMysqlRowBlock ``` gives you an ```` AsyncMysqlRowBlockIterator ````, where each key of that iterator is an ````` int ````` representing the key to an `````` AsyncMysqlRow `````` of that row block, and each value from ``````` current() ``````` is the actual ```````` AsyncMysqlRow ````````.




And then you can perform operations on that ` AsyncMysqlRow `, including get an iterator of that as well.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/getIterator/001-basic-usage.php @@
<!-- HHAPIDOC -->
