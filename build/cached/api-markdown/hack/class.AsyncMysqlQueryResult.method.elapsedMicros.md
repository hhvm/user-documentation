``` yamlmeta
{
    "name": "elapsedMicros",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryResult"
}
```




The total time for the successful query to occur, in microseconds




``` Hack
public function elapsedMicros(): int;
```




## Returns




+ ` int ` - the total successful result producing time as `` int `` microseconds.




## Examples




Every successful query has a result. And one of the methods on an ` AsyncMysqlQueryResult ` is `` elapsedMicros() ``, which tells you how long it took to perform the query and get the result.




Note that




```
  elapsedMicros() ~== endTime() - startTime()
```







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryResult/elapsedMicros/001-basic-usage.php @@
<!-- HHAPIDOC -->
