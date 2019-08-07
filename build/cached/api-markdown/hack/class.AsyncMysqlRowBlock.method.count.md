``` yamlmeta
{
    "name": "count",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Returns the number of rows in the current row block




``` Hack
public function count(): int;
```




## Returns




+ ` int ` - The number of rows in the current row block.




## Examples




The following example shows how to use ` AsyncMysqlRowBlock::count ` to get the number of rows in the given row block.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/count/001-basic-usage.php @@
<!-- HHAPIDOC -->
