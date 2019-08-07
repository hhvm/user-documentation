``` yamlmeta
{
    "name": "fieldsCount",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlRowBlock"
}
```




Returns the number of fields (columns) associated with the current row
block




``` Hack
public function fieldsCount(): int;
```




## Returns




+ ` int ` - The number of columns in the current row block.




## Examples




The following example shows how to use ` AsyncMysqlRowBlock::fieldsCount ` to get the total number of fields represented in the row block




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




So, in the example, given the table created with the SQL above, there are 4 fields.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlRowBlock/fieldsCount/001-basic-usage.php @@
<!-- HHAPIDOC -->
