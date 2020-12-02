The following example shows how to use `AsyncMysqlConnection::queryf`. First you get a connection from an `AsyncMysqlConnectionPool`; then you decide what parameters you want to pass as query placeholders.

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

async function get_data(
  \AsyncMysqlConnection $conn,
  string $col,
  int $id,
): Awaitable<\AsyncMysqlQueryResult> {
  return await $conn->queryf(
    'SELECT %C FROM test_table where userID = %d',
    $col,
    $id,
  );
}

async function simple_queryf(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await get_data($conn, 'name', 1);
  $x = $result->numRows();
  $result = await get_data($conn, 'name', 2);
  $conn->close();
  return $x + $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_queryf();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(1)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```

The following example uses the `%=s` placeholder in order to allow you to check whether an email address with the provided `string` exists in the table, or, if `null` is passed, whether there is a user with a `null` email address.

```percent-equal-placeholders.php
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

async function get_data(
  \AsyncMysqlConnection $conn,
  string $col,
  ?string $email,
): Awaitable<\AsyncMysqlQueryResult> {
  // %=s allows you to check an actual string value or IS NULL
  return await $conn->queryf(
    'SELECT %C FROM test_table where email %=s',
    $col,
    $email,
  );
}

async function simple_queryf(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await get_data($conn, 'name', 'joelm@fb.com');
  $x = $result->numRows();
  $result = await get_data($conn, 'name', null);
  $conn->close();
  return $x + $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_queryf();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(18)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```

The following example shows how to use the `%L` placeholder for `AsyncMysqlConnection::queryf`. First you get a connection from an `AsyncMysqlConnectionPool`; then we are passing a vector of ids to used in the placeholder. The placeholder ends up being `%Ld` since the ids are integers.

```percent-L-placeholders.php
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

async function get_data(
  \AsyncMysqlConnection $conn,
  Vector<int> $ids,
): Awaitable<\AsyncMysqlQueryResult> {
  return await $conn->queryf(
    'SELECT name FROM test_table where userID IN (%Ld)',
    $ids,
  );
}

async function percent_L_queryf(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $ids = Vector {1, 2};
  $result = await get_data($conn, $ids);
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await percent_L_queryf();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(1)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
