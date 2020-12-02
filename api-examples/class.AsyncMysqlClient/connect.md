The following example shows how to use `AsyncMysqlClient::connect()` to connect to a database asynchronously and get a result from that connection. Notice a couple of things:

* The parameters to `connect()` are very similar to that of a normal [`mysqli` connection](http://php.net/manual/en/mysqli.construct.php).
* With `AsyncMysqlClient`, we are able to take full advantage of [async](/hack/async/introduction) to perform other DB connection or I/O operations while waiting for this connection to return.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function do_connect(): Awaitable<\AsyncMysqlQueryResult> {
  // Cast because the array from get_connection_info() is a mixed
  $conn = await \AsyncMysqlClient::connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
  return await $conn->query('SELECT * FROM test_table');
}

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  $res = await do_connect();
  \var_dump($res->numRows()); // The number of rows from the SELECT statement
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(21)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
