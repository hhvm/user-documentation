``` yamlmeta
{
    "name": "connectWithOpts",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionPool"
}
```




``` Hack
public function connectWithOpts(
  string $host,
  int $port,
  string $dbname,
  string $user,
  string $password,
  AsyncMysqlConnectionOptions $conn_options,
  string $extra_key = '',
): Awaitable<AsyncMysqlConnection>;
```




## Parameters




+ ` string $host `
+ ` int $port `
+ ` string $dbname `
+ ` string $user `
+ ` string $password `
+ ` AsyncMysqlConnectionOptions $conn_options `
+ ` string $extra_key = '' `




## Returns




* ` Awaitable<AsyncMysqlConnection> `
<!-- HHAPIDOC -->
