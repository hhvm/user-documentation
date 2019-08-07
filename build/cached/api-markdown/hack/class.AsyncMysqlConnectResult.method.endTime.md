``` yamlmeta
{
    "name": "endTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectResult"
}
```




The end time of the connection operation, in seconds since epoch




``` Hack
public function endTime(): float;
```




## Returns




+ ` float ` - the end time as `` float `` seconds since epoch.




## Examples




Every connection has a connection result. You get the connection result from a call to ` AsyncMysqlConnection::connectResult `. And one of the methods on an `` AsyncMysqlConnectResult `` is ``` endTime() ```, which tells you when the connection operation completed.




Note that




```
  elapsedMicros() ~== endTime() - startTime()
```







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectResult/endTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
