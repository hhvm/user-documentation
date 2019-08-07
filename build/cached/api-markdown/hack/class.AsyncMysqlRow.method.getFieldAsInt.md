``` yamlmeta
{
    "name": "getFieldAsInt",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRow"
}
```




Get a certain field (column) value as an ` int `




``` Hack
public function getFieldAsInt(
  mixed $field,
): int;
```




If the column from which you are retrieving the value is not an integral
type, then an ` Exception ` is thrown.




## Parameters




+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` int ` - The `` int `` value of the field (column); or an ``` Exception ``` if it
  the column is not integral.




## Examples




The following example shows how to get a field value as an ` int ` value via `` AsyncMysqlRow::getFieldAsInt ``. Assume this was the SQL used to create the example table:




```
CREATE TABLE test_table (
userID SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
age SMALLINT NULL,
email VARCHAR(60) NULL,
PRIMARY KEY (userID)
);
```




In this case, we are actually getting a field that is an ` int ` (or `` SMALLINT ``).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRow/getFieldAsInt/001-basic-usage.php @@
<!-- HHAPIDOC -->
