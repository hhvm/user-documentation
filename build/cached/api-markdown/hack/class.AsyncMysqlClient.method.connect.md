``` yamlmeta
{
    "name": "connect",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClient"
}
```




Begin an async connection to a MySQL instance




``` Hack
public static function connect(
  string $host,
  int $port,
  string $dbname,
  string $user,
  string $password,
  int $timeout_micros = -1,
  ?MySSLContextProvider $ssl_provider = NULL,
): Awaitable<AsyncMysqlConnection>;
```




Use this to asynchronously connect to a MySQL instance.




Normally you would use this to make one asynchronous connection to the
MySQL client.




If you want to be able to pool up a bunch of connections, you would call
` setPoolsConnectionLimit() `, create a default pool of connections with
`` AsyncMysqlConnectionPool()::__construct() ``, which now
has that limit set, and then call ``` AsyncMysqlConnectionPool()::connect() ```.




## Parameters




+ ` string $host ` - The hostname to connect to.
+ ` int $port ` - The port to connect to.
+ ` string $dbname ` - The initial database to use when connecting.
+ ` string $user ` - The user to connect as.
+ ` string $password ` - The password to connect with.
+ ` int $timeout_micros = -1 ` - Timeout, in microseconds, for the connect; -1 for
  default, 0 for no timeout.
+ ` ?MySSLContextProvider $ssl_provider = NULL `




## Returns




* ` Awaitable<AsyncMysqlConnection> ` - an `` Awaitable `` representing an ``` AsyncMysqlConnection ```. ```` await ````
  or ````` join ````` this result to obtain the actual connection.




## Examples




The following example shows how to use ` AsyncMysqlClient::connect() ` to connect to a database asynchronously and get a result from that connection. Notice a couple of things:




- The parameters to ` connect() ` are very similar to that of a normal [` mysqli ` connection](<http://php.net/manual/en/mysqli.construct.php>).
- With ` AsyncMysqlClient `, we are able to take full advantage of [async](</hack/async/introduction>) to perform other DB connection or I/O operations while waiting for this connection to return.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlClient/connect/001-basic-usage.php @@
<!-- HHAPIDOC -->
