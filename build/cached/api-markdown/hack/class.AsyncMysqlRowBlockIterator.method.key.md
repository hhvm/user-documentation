``` yamlmeta
{
    "name": "key",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowBlockIterator"
}
```




Get the current row number







``` Hack
public function key(): int;
```




## Returns




+ ` int ` - The current row number associated with the current iterator
  position.




## Examples




The following example shows you how to use ` AsyncMysqlRowBlockIterator::key ` to get the actual key pointing to an `` AsyncMysqlRow `` within the block iterator. The key will be an ``` int ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlockIterator/key/001-basic-usage.php @@
<!-- HHAPIDOC -->
