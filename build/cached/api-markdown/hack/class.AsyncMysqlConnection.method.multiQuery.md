``` yamlmeta
{
    "name": "multiQuery",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Begin running a query with multiple statements




``` Hack
public function multiQuery(
      Traversable<string, arraykey, mixed> $queries,
  int $timeout_micros = -1,
  dict<string> $query_attributes = dict [
],
): Awaitable<Vector<AsyncMysqlQueryResult>>;
```




` AsyncMysqlConnection::multiQuery() ` is similar to
`` AsyncMysqlConnection::query() ``, except that you can pass an array of
``` string ``` queries to run one after the other. Then when you ```` await ```` or
````` join ````` on the returned `````` Awaitable ``````, you will get a ``````` Vector ``````` of
```````` AsyncMysqlQueryResult ````````, one result for each query.




We strongly recommend using multiple calls to ` queryf() ` instead as it
escapes parameters; multiple queries can be executed simultaneously by
combining `` queryf() `` with ``` HH\Asio\v() ```.




## Parameters




+ ` Traversable<string, arraykey, mixed> $queries ` - A `` Vector `` of queries, with each query being a ``` string ```
  in the array.
+ ` int $timeout_micros = -1 ` - The maximum time, in microseconds, in which the
  query must be completed; -1 for default, 0 for
  no timeout.
+ ` dict<string> $query_attributes = dict [ ] ` - Query attributes. Empty by default.




## Returns




* ` Awaitable<Vector<AsyncMysqlQueryResult>> ` - an `` Awaitable `` representing the result of your multi-query. Use
  ``` await ``` or ```` join ```` to get the actual ````` Vector ````` of
  `````` AsyncMysqlQueryResult `````` objects.




## Examples




` AsyncMysqlConnection::multiQuery ` is similar to `` AsyncMysqlConnection::query ``, except that you can pass an array of queries to run one after the other. Then when you ``` await ``` on the call, you will get a ```` Vector ```` of ````` AsyncMysqlQueryResult `````, one result for each query.










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnection/multiQuery/001-basic-usage.php @@
<!-- HHAPIDOC -->
