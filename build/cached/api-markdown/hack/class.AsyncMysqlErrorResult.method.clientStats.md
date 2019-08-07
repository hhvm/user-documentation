``` yamlmeta
{
    "name": "clientStats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




Returns the MySQL client statistics for the events that produced the error




``` Hack
public function clientStats(): AsyncMysqlClientStats;
```




This information can be used to know how the performance of the
MySQL client may have affected the operation that produced the error.




## Returns




+ ` AsyncMysqlClientStats ` - an `` AsyncMysqlClientStats `` object to query about event and
  callback timing to the MySQL client for whatever caused the
  error.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` clientStats() ```, which gives you some information about the client you are connecting too.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/clientStats/001-basic-usage.php @@
<!-- HHAPIDOC -->
