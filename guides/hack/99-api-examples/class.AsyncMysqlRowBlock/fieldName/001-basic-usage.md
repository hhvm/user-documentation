The following example shows how to use `AsyncMysqlRowBlock::fieldName` to get the name of a field at a given index in the row block

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
