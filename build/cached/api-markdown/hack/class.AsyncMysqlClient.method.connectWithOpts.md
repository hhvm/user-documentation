``` yamlmeta
{
    "name": "connectWithOpts",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClient"
}
```




Begin an async connection to a MySQL instance




``` Hack
public static function connectWithOpts(
  string $host,
  int $port,
  string $dbname,
  string $user,
  string $password,
  AsyncMysqlConnectionOptions $conn_opts,
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
+ ` AsyncMysqlConnectionOptions $conn_opts `




## Returns




* ` Awaitable<AsyncMysqlConnection> ` - an `` Awaitable `` representing an ``` AsyncMysqlConnection ```. ```` await ````
  or ````` join ````` this result to obtain the actual connection.
<!-- HHAPIDOC -->
