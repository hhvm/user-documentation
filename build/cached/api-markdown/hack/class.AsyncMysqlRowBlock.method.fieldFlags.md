``` yamlmeta
{
    "name": "fieldFlags",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Returns the flags of the field (column)




``` Hack
public function fieldFlags(
  mixed $field,
): int;
```




This gets the bitwise ` OR ` of the flags that are set for a given column.




See [here](<http://goo.gl/1RCN2l>) for the possible flags.




## Parameters




+ ` mixed $field ` - the field index (`` int ``) or field name (``` string ```).




## Returns




* ` int ` - The flags of the column as an `` int ``.




## Examples




The following example shows how to use ` AsyncMysqlRowBlock::fieldFlags ` to get the bitwise `` OR `` combination of the flags that are set for the ``` userID ``` field. The flags are as follows:




| Flag Value | Flag Description | Int Value |
| - | - | - |
| NOT_NULL_FLAG | Field cannot be NULL | 1 |
| PRI_KEY_FLAG | Field is part of a primary key | 2 |
| UNIQUE_KEY_FLAG | Field is part of a unique key | 4 |
| MULTIPLE_KEY_FLAG | Field is part of a nonunique key | 8 |
| BLOB_FLAG | Field is a BLOB or TEXT (deprecated) | 16 |
| UNSIGNED_FLAG | Field has the UNSIGNED attribute | 32 |
| ZEROFILL_FLAG | Field has the ZEROFILL attribute | 64 |
| BINARY_FLAG | Field has the BINARY attribute | 128 |
| AUTO_INCREMENT_FLAG | Field has the AUTO_INCREMENT attribute | 256 |
| ENUM_FLAG | Field is an ENUM | 512 |
| SET_FLAG | Field is a SET | 1024 |
| TIMESTAMP_FLAG | Field is a TIMESTAMP (deprecated) | 2048 |
| NO_DEFAULT_VALUE_FLAG | Field has no default value; see additional notes following table | 4096 |
| PART_KEY_FLAG | Field is at least part of a key | 16384 |
| NUM_FLAG | Field is numeric; see additional notes following table | 32768 |




See: [http://mflib.org/mysql/include/mysql_com.h](<http://mflib.org/mysql/include/mysql_com.h>)




This is an example of what could have been used to create the table from where we are getting our field flags




```
CREATE TABLE test_table (
userID SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
age SMALLINT NULL,
email VARCHAR(60) NULL,
PRIMARY KEY (userID)
);
```







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/fieldFlags/001-basic-usage.php @@
<!-- HHAPIDOC -->
