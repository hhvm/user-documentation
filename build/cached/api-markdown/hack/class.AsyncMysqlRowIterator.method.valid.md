``` yamlmeta
{
    "name": "valid",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowIterator"
}
```




Check if the iterator is at a valid field (column)




``` Hack
public function valid(): bool;
```




## Returns




+ ` bool ` - `` true `` if the iterator is still pointing to a valid column;
  otherwise ``` false ```.




## Examples




The following example shows how to use ` AsyncMysqlRowIterator::valid ` to determine whether the current iterator is still valid (i.e., there was actually something to iterate over, or we have reached the end).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowIterator/valid/001-basic-usage.php @@
<!-- HHAPIDOC -->
