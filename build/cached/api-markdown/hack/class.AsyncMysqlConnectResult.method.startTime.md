``` yamlmeta
{
    "name": "startTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectResult"
}
```




The start time for the connection operation, in seconds since epoch




``` Hack
public function startTime(): float;
```




## Returns




+ ` float ` - the start time as `` float `` seconds since epoch.




## Examples




Every connection has a connection result. You get the connection result from a call to ` AsyncMysqlConnection::connectResult `. And one of the methods on an `` AsyncMysqlConnectResult `` is ``` startTime() ```, which tells you when the connection operation started.




Note that




```
  elapsedMicros() ~== endTime() - startTime()
```







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlConnectResult/startTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
