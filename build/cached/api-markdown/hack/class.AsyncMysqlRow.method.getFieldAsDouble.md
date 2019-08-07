``` yamlmeta
{
    "name": "getFieldAsDouble",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRow"
}
```




Get a certain field (column) value as a ` double `




``` Hack
public function getFieldAsDouble(
  mixed $field,
): float;
```




If the column from which you are retrieving the value is not an numeric
type, then an ` Exception ` is thrown.




## Parameters




+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` float ` - The `` double `` value of the field (column); or an ``` Exception ``` if it
  the column is not numeric.




## Examples




The following example shows how to get a field value as a ` float ` value via `` AsyncMysqlRow::getFieldAsDouble ``. Assume this was the SQL used to create the example table:




```
CREATE TABLE test_table (
userID SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
age SMALLINT NULL,
email VARCHAR(60) NULL,
PRIMARY KEY (userID)
);
```




In this case, we are actually getting a field that is an ` int ` (or `` SMALLINT ``). But there is an automatic conversion to a ``` float ```.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRow/getFieldAsDouble/001-basic-usage.php @@
<!-- HHAPIDOC -->
