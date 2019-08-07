``` yamlmeta
{
    "name": "getFieldAsString",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Get a certain field (column) value from a certain row as ` string `




``` Hack
public function getFieldAsString(
  int $row,
  mixed $field,
): string;
```




## Parameters




+ ` int $row ` - the row index.
+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` string ` - The `` string `` value of the field (column).




## Examples




The following example shows how to get a field value as an ` string ` value via `` AsyncMysqlRowBlock::getFieldAsString ``. Assume this was the SQL used to create the example table:




```
CREATE TABLE test_table (
userID SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
age SMALLINT NULL,
email VARCHAR(60) NULL,
PRIMARY KEY (userID)
);
```




In this case, we are actually getting a field that is a ` string ` (or `` VARCHAR ``).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/getFieldAsString/001-basic-usage.php @@
<!-- HHAPIDOC -->
