``` yamlmeta
{
    "name": "endTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




The end time when the error was produced, in seconds since epoch




``` Hack
public function endTime(): float;
```




## Returns




+ ` float ` - the end time as `` float `` seconds since epoch.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` endTime() ```, which tells you when the connection operation completed.




Note that




```
  elapsedMicros() ~== endTime() - startTime()
```










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/endTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
