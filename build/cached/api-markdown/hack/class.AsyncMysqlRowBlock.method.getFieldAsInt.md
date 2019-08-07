``` yamlmeta
{
    "name": "getFieldAsInt",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Get a certain field (column) value from a certain row as ` int `




``` Hack
public function getFieldAsInt(
  int $row,
  mixed $field,
): int;
```




If the column from which you are retrieving the value is not an integral
type, then an ` Exception ` is thrown.




## Parameters




+ ` int $row ` - the row index.
+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` int ` - The `` int `` value of the field (column); or an ``` Exception ``` if it
  the column is not integral.




## Examples




The following example shows how to get a field value as an ` int ` value via `` AsyncMysqlRowBlock::getFieldAsInt ``. Assume this was the SQL used to create the example table:




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







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/getFieldAsInt/001-basic-usage.php @@
<!-- HHAPIDOC -->
