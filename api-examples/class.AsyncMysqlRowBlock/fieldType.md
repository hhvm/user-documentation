The following example shows how to use `AsyncMysqlRowBlock::fieldType` to get the data type of the `email` field. Here are the available data types:

Type Value | Type Description | Int Value
---------- | ---------------- | ---------
MYSQL_TYPE_DECIMAL | DECIMAL or NUMERIC field | 0
MYSQL_TYPE_TINY | TINYINT field | 1
MYSQL_TYPE_SHORT  |  SMALLINT field | 2
MYSQL_TYPE_LONG | INTEGER field | 3
MYSQL_TYPE_FLOAT  |  FLOAT field | 4
MYSQL_TYPE_DOUBLE | DOUBLE or REAL field | 5
MYSQL_TYPE_NULL | NULL-type field | 6
MYSQL_TYPE_TIMESTAMP |   TIMESTAMP field | 7
MYSQL_TYPE_LONGLONG | BIGINT field | 8
MYSQL_TYPE_INT24  |  MEDIUMINT field | 9
MYSQL_TYPE_DATE | DATE field | 10
MYSQL_TYPE_TIME | TIME field | 11
MYSQL_TYPE_DATETIME | DATETIME field | 12
MYSQL_TYPE_YEAR | YEAR field | 13
MYSQL_TYPE_BIT | BIT field (MySQL 5.0.3 and up) | 16
MYSQL_TYPE_NEWDECIMAL  | Precision math DECIMAL or NUMERIC field (MySQL 5.0.3 and up) | 246
MYSQL_TYPE_ENUM | ENUM field | 247
MYSQL_TYPE_SET | SET field | 248
MYSQL_TYPE_BLOB | BLOB or TEXT field (use max_length to determine the maximum length) | 252
MYSQL_TYPE_VAR_STRING  | VARCHAR or VARBINARY field | 253
MYSQL_TYPE_STRING  | CHAR or BINARY field | 254
MYSQL_TYPE_GEOMETRY | Spatial field | 255


See: [http://mflib.org/mysql/include/mysql_com.h](http://mflib.org/mysql/include/mysql_com.h) and [https://dev.mysql.com/doc/refman/5.0/en/c-api-data-structures.html](https://dev.mysql.com/doc/refman/5.0/en/c-api-data-structures.html).

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

So, in our example, 253 would be returned for the `email` field.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(
  \AsyncMysqlConnectionPool $pool,
): Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
}
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await $conn->query('SELECT * FROM test_table WHERE userID < 50');
  $conn->close();
  // A call to $result->rowBlocks() actually pops the first element of the
  // row block Vector. So the call actually mutates the Vector.
  $row_blocks = $result->rowBlocks();
  if ($row_blocks->count() > 0) {
    // An AsyncMysqlRowBlock
    $row_block = $row_blocks[0];
    return $row_block->fieldType('email'); // int
  } else {
    return -1;
  }
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(253)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
