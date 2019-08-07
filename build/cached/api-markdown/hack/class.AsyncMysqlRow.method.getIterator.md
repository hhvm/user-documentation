``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRow"
}
```




Get the iterator over the fields in the current row




``` Hack
public function getIterator(): AsyncMysqlRowIterator<string, mixed>;
```




## Returns




+ ` AsyncMysqlRowIterator<string, mixed> ` - An `` AsyncMysqlRowIterator `` to iterate over the current row.




## Examples




The following example shows you how to get an iterator of an ` AsyncMysqlRow ` via `` getIterator() ``. Getting an iterator of an ``` AsyncMysqlRow ``` gives you an ```` AsyncMysqlRowIterator ````, where each key of that iterator is an ````` int ````` representing the key to the field of the `````` AsyncMysqlRow ``````, and each value from ``````` current() ``````` is the value of the field of that ```````` AsyncMysqlRow ````````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRow/getIterator/001-basic-usage.php @@
<!-- HHAPIDOC -->
