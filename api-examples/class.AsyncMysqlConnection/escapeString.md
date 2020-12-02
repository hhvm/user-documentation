The following example shows you how to use `AsyncMysqlConnection::escapeString`
in order to make sure any string pass to something like
`AsyncMysqlConnection::query` is safe for a database query. This is similar to
[`mysql_real_escape_string`](http://php.net/manual/en/function.mysql-real-escape-string.php).

We *strongly* recommend using an API like `AsyncMysqlConnection::queryf` instead,
which automatically escapes strings passed to `%s` placeholders.

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
  string $name,
): Awaitable<\AsyncMysqlQueryResult> {
  /* DON'T DO THIS!
   *
   * Use AsyncMysqlConnection::queryf() instead, which automatically escapes
   * strings for %s placeholders.
   */
  $escaped_name = $conn->escapeString($name);
  \var_dump($escaped_name);
  return await $conn->query(
    "SELECT age FROM test_table where name = '".$escaped_name."'",
  );
}
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await get_data($conn, 'Joel Marcey');
  $x = $result->numRows();
  $result = await get_data($conn, 'Daffy\nDuck');
  $conn->close();
  return $x + $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
}
```.hhvm.expect
string(11) "Joel Marcey"
string(12) "Daffy\\nDuck"
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
