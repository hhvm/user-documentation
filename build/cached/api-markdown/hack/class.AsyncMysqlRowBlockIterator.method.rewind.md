``` yamlmeta
{
    "name": "rewind",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowBlockIterator"
}
```




Reset the iterator to the first row




``` Hack
public function rewind(): void;
```




## Returns




+ ` void `




## Examples




The following example shows how to use ` AsyncMysqlRowBlockIterator::rewind ` to get back to the beginning of the iterator as necessary.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlockIterator/rewind/001-basic-usage.php @@
<!-- HHAPIDOC -->
