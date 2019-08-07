``` yamlmeta
{
    "name": "connect",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionPool"
}
```




Begin an async connection to a MySQL instance




``` Hack
public function connect(
  string $host,
  int $port,
  string $dbname,
  string $user,
  string $password,
  int $timeout_micros = -1,
  string $extra_key = '',
): Awaitable<AsyncMysqlConnection>;
```




Once you have your pool constructed, you use this method to connect to the
MySQL client. The connection pool will either create a new connection or
use one of the recently available connections from the pool itself.




## Parameters




+ ` string $host ` - The hostname to connect to.
+ ` int $port ` - The port to connect to.
+ ` string $dbname ` - The initial database to use when connecting.
+ ` string $user ` - The user to connect as.
+ ` string $password ` - The password to connect with.
+ ` int $timeout_micros = -1 ` - Timeout, in microseconds, for the connect; -1
  for default, 0 for no timeout.
+ ` string $extra_key = '' ` - An extra parameter to help the internal connection
  pool infrastructure separate connections even better.
  Usually, the default `` "" `` is fine.




## Returns




* ` Awaitable<AsyncMysqlConnection> `




## Examples




It is **highly recommended** that you use connection pools when using async MySQL. That way you don't have to create a new connection every time you want to make a query to the database. The following example shows you how to connect to a MySQL database using an ` AsyncMySqlConnectionPool `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectionPool/connect/001-basic-usage.php @@
<!-- HHAPIDOC -->
