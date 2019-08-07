``` yamlmeta
{
    "name": "callbackDelayMicrosAvg",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClientStats"
}
```




Average delay between when a callback is scheduled in the MySQL client
and when it's actually ran, in microseconds




``` Hack
public function callbackDelayMicrosAvg(): float;
```




The callback can be from creating a connection, inducing an error
condition, executing a query, etc.




This returns an exponentially-smoothed average.




## Returns




+ ` float ` - A `` float `` representing the average callback delay on this
  MySQL client.




## Examples




The following example describes how to get the average delay time between when a callback is scheduled (in this case, performing the connection) and when the callback actual ran (in this case, when the connection was actually established) via ` AsyncMysqlClientStats::callbackDelayMicrosAvg `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlClientStats/callbackDelayMicrosAvg/001-basic-usage.php @@
<!-- HHAPIDOC -->
