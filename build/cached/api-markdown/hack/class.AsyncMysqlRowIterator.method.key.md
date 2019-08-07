``` yamlmeta
{
    "name": "key",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowIterator"
}
```




Get the current field (column) number




``` Hack
public function key(): int;
```




## Returns




+ ` int ` - The column number associated with the current iterator position.




## Examples




The following example shows you how to use ` AsyncMysqlRowIterator::key ` to get the actual `` int `` key pointing to the field within the row iterator.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowIterator/key/001-basic-usage.php @@
<!-- HHAPIDOC -->
