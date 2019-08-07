``` yamlmeta
{
    "name": "AsyncMysqlConnectionPool",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionPool"
}
```




An asynchronous MySQL connection pool




This class provides a mechanism to create a pool of connections to a MySQL
client that can be utilized and reused as needed.




When a client requests a connection from the pool, it may get one that
already exists; this avoids the overhead of establishing a new connection.




This is the *highly recommended* way to create connections to a MySQL
client, as opposed to using the ` AsyncMysqlClient ` class which does not give
you nearly the flexibility. In fact, there is discussion about deprecating
the `` AsyncMysqlClient `` class all together.




## Interface Synopsis




``` Hack
class AsyncMysqlConnectionPool {...}
```




### Public Methods




+ [` ->__construct(darray<string, mixed> $pool_options): void `](</hack/reference/class/AsyncMysqlConnectionPool/__construct/>)\
  Create a pool of connections to access a MySQL client
+ [` ->connect(string $host, int $port, string $dbname, string $user, string $password, int $timeout_micros = -1, string $extra_key = ''): Awaitable<AsyncMysqlConnection> `](</hack/reference/class/AsyncMysqlConnectionPool/connect/>)\
  Begin an async connection to a MySQL instance
+ [` ->connectWithOpts(string $host, int $port, string $dbname, string $user, string $password, AsyncMysqlConnectionOptions $conn_options, string $extra_key = ''): Awaitable<AsyncMysqlConnection> `](</hack/reference/class/AsyncMysqlConnectionPool/connectWithOpts/>)
+ [` ->getPoolStats(): darray<string, mixed> `](</hack/reference/class/AsyncMysqlConnectionPool/getPoolStats/>)\
  Returns statistical information for the current pool
<!-- HHAPIDOC -->
