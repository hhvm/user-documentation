``` yamlmeta
{
    "name": "AsyncMysqlClient",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClient"
}
```




An asynchronous MySQL client




This class allows you to asynchronously connect to a MySQL client. You
can directly connect to the MySQL client with the ` connect() ` method; in
addition you can use this class in conjunction with
`` AsyncMysqlConnectionPool `` pools by setting the limit of connections on
any given pool, and using ``` AsyncMysqlConnectionPool::connect() ```.




There is some duplication with this class. If possible, you should directly
construct connection pools via ` new AsyncMysqlConnectionPool() ` and then
call `` AsyncMysqlConnectionPool::connect() `` to connect to the MySQL client
using those pools. Here we optionally set pool limits and call ``` connect() ```
on this class. ```` AsyncMysqlConnectionPool ```` provides more flexibility with
other available options, etc.




In fact, there is discussion about deprecating ` AsyncMysqlClient ` all
together to avoid having this choice. But, for now, you can use this class
for asynchronous connection(s) to a MySQL database.




## Interface Synopsis




``` Hack
final class AsyncMysqlClient {...}
```




### Public Methods




+ [` ::adoptConnection(mixed $connection): AsyncMysqlConnection `](</hack/reference/class/AsyncMysqlClient/adoptConnection/>)\
  Create a new async connection from a synchronous MySQL instance
+ [` ::connect(string $host, int $port, string $dbname, string $user, string $password, int $timeout_micros = -1, ?MySSLContextProvider $ssl_provider = NULL): Awaitable<AsyncMysqlConnection> `](</hack/reference/class/AsyncMysqlClient/connect/>)\
  Begin an async connection to a MySQL instance
+ [` ::connectAndQuery( arraylike<string, arraykey> $queries, string $host, int $port, string $dbname, string $user, string $password, AsyncMysqlConnectionOptions $conn_opts, dict<string> $query_attributes = dict [ ]): Awaitable<tuple<AsyncMysqlConnectResult, Vector<AsyncMysqlQueryResult>, Vector<AsyncMysqlQueryResult>>> `](</hack/reference/class/AsyncMysqlClient/connectAndQuery/>)\
  Begin an async connection and query  to a MySQL instance
+ [` ::connectWithOpts(string $host, int $port, string $dbname, string $user, string $password, AsyncMysqlConnectionOptions $conn_opts): Awaitable<AsyncMysqlConnection> `](</hack/reference/class/AsyncMysqlClient/connectWithOpts/>)\
  Begin an async connection to a MySQL instance
+ [` ::setPoolsConnectionLimit(int $limit): void `](</hack/reference/class/AsyncMysqlClient/setPoolsConnectionLimit/>)\
  Sets the connection limit of all connection pools using this client







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlClient/__construct/>)
<!-- HHAPIDOC -->
