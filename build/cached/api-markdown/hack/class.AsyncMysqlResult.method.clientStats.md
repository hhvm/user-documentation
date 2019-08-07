``` yamlmeta
{
    "name": "clientStats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlResult"
}
```




Returns the MySQL client statistics at the moment the result was created




``` Hack
abstract public function clientStats(): AsyncMysqlClientStats;
```




This information can be used to know how the performance of the MySQL
client may have affected the result.




## Returns




+ ` AsyncMysqlClientStats ` - an `` AsyncMysqlClientStats `` object to query about event and
  callback timing to the MySQL client for the specific result.




## Examples




AsyncMysqlResult is abstract. See specific, concrete classes for examples of ` AsyncMysqlResult::clientStats ` (e.g., AsyncMysqlConnectResult, AsyncMysqlErrorResult)







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlResult/clientStats/001-basic-usage.php @@
<!-- HHAPIDOC -->
