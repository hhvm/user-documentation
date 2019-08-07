``` yamlmeta
{
    "name": "next",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php"
    ],
    "class": "AsyncMysqlRowBlockIterator"
}
```




Advance the iterator to the next row




``` Hack
public function next(): void;
```




## Returns




+ ` void `




## Examples




The following example shows you how to use ` AsyncMysqlRowBlockIterator::next ` to move on to the next `` AsyncMysqlRow `` in the iterator, assuming one exists.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlockIterator/next/001-basic-usage.php @@
<!-- HHAPIDOC -->
