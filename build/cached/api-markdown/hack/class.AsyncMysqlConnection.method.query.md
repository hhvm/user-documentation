``` yamlmeta
{
    "name": "query",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Begin running an unsafe query on the MySQL database client




``` Hack
public function query(
  string $query,
  int $timeout_micros = -1,
  dict<string> $query_attributes = dict [
],
): Awaitable<AsyncMysqlQueryResult>;
```




If you have a direct query that requires no placeholders, then you can
use this method. It takes a raw string query that will be executed as-is.




You may want to call ` escapeString() ` to ensure that any queries out of
your direct control are safe.




We strongly recommend using ` queryf() ` instead in all cases, which
automatically escapes parameters.




## Parameters




+ ` string $query ` - The query itself.
+ ` int $timeout_micros = -1 ` - The maximum time, in microseconds, in which the
  query must be completed; -1 for default, 0 for
  no timeout.
+ ` dict<string> $query_attributes = dict [ ] ` - Query attributes. Empty by default.




## Returns




* ` Awaitable<AsyncMysqlQueryResult> ` - an `` Awaitable `` representing the result of your query. Use
  ``` await ``` or ```` join ```` to get the actual ````` AsyncMysqlQueryResult `````
  object.




## Examples




The following example shows a basic usage of ` AsyncMysqlConnection::query `. First you get a connection from an `` AsyncMysqlConnectionPool ``, then you can make the query.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/query/001-basic-usage.php @@
<!-- HHAPIDOC -->
