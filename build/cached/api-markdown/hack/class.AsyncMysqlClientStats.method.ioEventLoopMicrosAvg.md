``` yamlmeta
{
    "name": "ioEventLoopMicrosAvg",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClientStats"
}
```




Average loop time of the MySQL client event, in microseconds




``` Hack
public function ioEventLoopMicrosAvg(): float;
```




An event can include a connection, an error condition, a query, etc.




This returns an exponentially-smoothed average.




## Returns




+ ` float ` - A `` float `` representing the average for an event to happen on this
  MySQL client.




## Examples




The following example describes how to get the average loop time of this SQL client's event handling (in this particular case, performing the connection) via ` AsyncMysqlClientStats::ioEventLoopMicrosAvg `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlClientStats/ioEventLoopMicrosAvg/001-basic-usage.php @@
<!-- HHAPIDOC -->
