``` yamlmeta
{
    "name": "startTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




The start time when the error was produced, in seconds since epoch




``` Hack
public function startTime(): float;
```




## Returns




+ ` float ` - the start time as `` float `` seconds since epoch.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` startTime() ```, which tells you when the connection operation began.




Note that




```
  elapsedMicros() ~== endTime() - startTime()
```










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/startTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
