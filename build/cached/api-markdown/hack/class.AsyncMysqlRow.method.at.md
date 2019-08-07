``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRow"
}
```




Get field (column) value indexed by the ` field `




``` Hack
public function at(
  mixed $field,
): mixed;
```




## Parameters




+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` mixed ` - The value of the field (column).




## Examples




The following example shows how to use ` AsyncMysqlRow::at ` to get a field value from the resulting row block. In this case, we get a `` Vector `` of ``` AsyncMysqlRowBlock ```s, then the first row block in that ```` Vector ````, then the first ````` AsyncMysqlRow ````` in that row block. Finally, we get the value of the `````` age `````` field in that row.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRow/at/001-basic-usage.php @@
<!-- HHAPIDOC -->
