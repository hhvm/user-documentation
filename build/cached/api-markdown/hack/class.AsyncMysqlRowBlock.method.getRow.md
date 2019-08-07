``` yamlmeta
{
    "name": "getRow",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Get a certain row in the current row block




``` Hack
public function getRow(
  int $row,
): AsyncMysqlRow;
```




## Parameters




+ ` int $row ` - the row index.




## Returns




* ` AsyncMysqlRow ` - The `` AsyncMysqlRow `` representing one specific row in the current
  row block.




## Examples




The following example shows you how to get a row from a row block via ` AsyncMysqlRowBlock::getRow `. You pass an `` int `` specifying the row of the row block you want.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/getRow/001-basic-usage.php @@
<!-- HHAPIDOC -->
