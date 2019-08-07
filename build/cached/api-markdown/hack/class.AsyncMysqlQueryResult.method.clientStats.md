``` yamlmeta
{
    "name": "clientStats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




Returns the MySQL client statistics at the moment the successful query
ended




``` Hack
public function clientStats(): AsyncMysqlClientStats;
```




This information can be used to know how the performance of the
MySQL client may have affected the query operation.




## Returns




+ ` AsyncMysqlClientStats ` - an `` AsyncMysqlClientStats `` object to query about event and
  callback timing to the MySQL client for the query.




## Examples




You can get some statistical information from the MySQL client when you get an ` AsyncMysqlQueryResult ` via the `` clientStats() `` method.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/clientStats/001-basic-usage.php @@
<!-- HHAPIDOC -->
