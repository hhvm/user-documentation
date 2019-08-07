``` yamlmeta
{
    "name": "at",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Get a field (column) value




``` Hack
public function at(
  int $row,
  mixed $field,
): mixed;
```




## Parameters




+ ` int $row ` - the row index.
+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` mixed ` - The value of the field (column) at the given row.




## Examples




The following example shows how to use ` AsyncMysqlRowBlock::at ` to get a field value from the resulting row block. In this case we are looking at the 0th element of the row block and wanting the age field.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/at/001-basic-usage.php @@
<!-- HHAPIDOC -->
