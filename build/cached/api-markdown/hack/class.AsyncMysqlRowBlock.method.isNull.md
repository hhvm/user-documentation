``` yamlmeta
{
    "name": "isNull",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Returns whether a field (column) value is ` null `




``` Hack
public function isNull(
  int $row,
  mixed $field,
): bool;
```




## Parameters




+ ` int $row ` - the row index.
+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` bool ` - `` true `` if the column value is ``` null ```; ```` false ```` otherwise.




## Examples




The following example uses ` AsyncMysqlRowBlock::isNull ` to check if a field value is `` null `` (e.g., if a field was set in SQL to something like ``` age SMALLINT NULL ```, then that field *could* be ```` null ````).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/isNull/001-basic-usage.php @@
<!-- HHAPIDOC -->
