``` yamlmeta
{
    "name": "elapsedMicros",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlResult"
}
```




The total time for the specific MySQL operation, in microseconds




``` Hack
abstract public function elapsedMicros(): int;
```




## Returns




+ ` int ` - the total operation time as `` int `` microseconds.




## Examples




AsyncMysqlResult is abstract. See specific, concrete classes for examples of ` AsyncMysqlResult::elapsedMicros ` (e.g., AsyncMysqlConnectResult, AsyncMysqlErrorResult)







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlResult/elapsedMicros/001-basic-usage.php @@
<!-- HHAPIDOC -->
