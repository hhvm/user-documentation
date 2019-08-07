``` yamlmeta
{
    "name": "clientStats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectResult"
}
```




Returns the MySQL client statistics at the moment the connection was
established




``` Hack
public function clientStats(): AsyncMysqlClientStats;
```




This information can be used to know how the performance of the
MySQL client may have affected the connecting operation.




## Returns




+ ` AsyncMysqlClientStats ` - an `` AsyncMysqlClientStats `` object to query about event and
  callback timing to the MySQL client for the connection.




## Examples




Every connection has a connection result. You get the connection result from a call to ` AsyncMysqlConnection::connectResult `. And one of the methods on an `` AsyncMysqlConnectResult `` is ``` clientStats() ```, which gives you some information about the client you are connecting too.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectResult/clientStats/001-basic-usage.php @@
<!-- HHAPIDOC -->
