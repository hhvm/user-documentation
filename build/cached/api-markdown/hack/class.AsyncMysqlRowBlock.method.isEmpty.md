``` yamlmeta
{
    "name": "isEmpty",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Returns whether there were any rows are returned in the current row block




``` Hack
public function isEmpty(): bool;
```




## Returns




+ ` bool ` - `` true `` if there are rows; ``` false ``` otherwise.




## Examples




The following example uses ` AsyncMysqlRowBlock::isEmpty ` to determine whether there are actually any row_blocks returned from the call to `` AsyncMysqlRowBlock::rowBlocks() `` method







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/isEmpty/001-basic-usage.php @@
<!-- HHAPIDOC -->
