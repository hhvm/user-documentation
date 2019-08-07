``` yamlmeta
{
    "name": "count",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRow"
}
```




Get the number of fields (columns) in the current row




``` Hack
public function count(): int;
```




## Returns




+ ` int ` - The number of columns in the current row.




## Examples




The following example shows how to use ` AsyncMysqlRow:count ` to get the number of fields in the given row.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRow/count/001-basic-usage.php @@
<!-- HHAPIDOC -->
