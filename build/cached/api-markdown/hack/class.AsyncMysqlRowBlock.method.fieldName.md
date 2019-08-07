``` yamlmeta
{
    "name": "fieldName",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Returns the name of the field (column)




``` Hack
public function fieldName(
  int $field,
): string;
```




## Parameters




+ ` int $field ` - the field index.




## Returns




* ` string ` - The name of the column as a `` string ``.




## Examples




The following example shows how to use ` AsyncMysqlRowBlock::fieldName ` to get the name of a field at a given index in the row block




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




So, in the example, given the table created with the SQL above, the string "age" would be returned (0-indexed).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/fieldName/001-basic-usage.php @@
<!-- HHAPIDOC -->
