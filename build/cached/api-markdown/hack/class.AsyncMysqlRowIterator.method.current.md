``` yamlmeta
{
    "name": "current",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowIterator"
}
```




Get the current field (column) name




``` Hack
public function current(): string;
```




## Returns




+ ` string ` - The column name associated with the current iterator
  position.




## Examples




The following example shows you how to use ` AsyncMysqlRowIterator::current ` to get a field value from the iterator.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowIterator/current/001-basic-usage.php @@
<!-- HHAPIDOC -->
