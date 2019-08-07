``` yamlmeta
{
    "name": "startTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The start time when the successful query began, in seconds since epoch




``` Hack
public function startTime(): float;
```




## Returns




+ ` float ` - the start time as `` float `` seconds since epoch.




## Examples




Every successful query has a result. And one of the methods on an ` AsyncMysqlQueryResult ` is `` startTime() ``, which tells you the time when we started to get our result.




Note that




```
  elapsedMicros() ~== endTime() - startTime()
```







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/startTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
