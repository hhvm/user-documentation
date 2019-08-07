``` yamlmeta
{
    "name": "rewind",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowIterator"
}
```




Reset the iterator to the first field (column)




``` Hack
public function rewind(): void;
```




## Returns




+ ` void `




## Examples




The following example shows how to use ` AsyncMysqlRowIterator::rewind ` to get back to the beginning of the iterator as necessary.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowIterator/rewind/001-basic-usage.php @@
<!-- HHAPIDOC -->
