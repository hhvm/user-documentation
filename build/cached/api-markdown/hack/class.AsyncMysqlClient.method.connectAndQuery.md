``` yamlmeta
{
    "name": "connectAndQuery",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClient"
}
```




Begin an async connection and query  to a MySQL instance




``` Hack
public static function connectAndQuery(
                                          arraylike<string, arraykey> $queries,
  string $host,
  int $port,
  string $dbname,
  string $user,
  string $password,
  AsyncMysqlConnectionOptions $conn_opts,
  dict<string> $query_attributes = dict [
],
): Awaitable<tuple<AsyncMysqlConnectResult, Vector<AsyncMysqlQueryResult>,                                           Vector<AsyncMysqlQueryResult>>>;
```




Use this to asynchronously connect and query a MySQL instance.




Normally you would use this to make one query to the
MySQL client.




If you want to be able to reuse the connection use connect or
connectWithOpts




## Parameters




+ ` arraylike<string, arraykey> $queries `
+ ` string $host ` - The hostname to connect to.
+ ` int $port ` - The port to connect to.
+ ` string $dbname ` - The initial database to use when connecting.
+ ` string $user ` - The user to connect as.
+ ` string $password ` - The password to connect with.
+ ` AsyncMysqlConnectionOptions $conn_opts `
+ ` dict<string> $query_attributes = dict [ ] ` - Query attributes. Empty by default.




## Returns




* ` Awaitable<tuple<AsyncMysqlConnectResult, Vector<AsyncMysqlQueryResult>, Vector<AsyncMysqlQueryResult>>> ` - an `` Awaitable `` representing the result of your connect and query
  This is a tuple where the latter contains information about the connection
  retrieval, and the former has the query results
<!-- HHAPIDOC -->
