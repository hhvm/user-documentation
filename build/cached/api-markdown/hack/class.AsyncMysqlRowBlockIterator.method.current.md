``` yamlmeta
{
    "name": "current",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowBlockIterator"
}
```




Get the current row




``` Hack
public function current(): AsyncMysqlRow;
```




## Returns




+ ` AsyncMysqlRow ` - The `` AsyncMysqlRow `` associated with the current iterator
  position.




## Examples




The following example shows you how to use ` AsyncMysqlRowBlockIterator::current ` to get an `` AsyncMysqlRow `` from the iterator.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlockIterator/current/001-basic-usage.php @@
<!-- HHAPIDOC -->
