``` yamlmeta
{
    "name": "endTime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlResult"
}
```




The end time for the specific MySQL operation, in seconds since epoch




``` Hack
abstract public function endTime(): float;
```




## Returns




+ ` float ` - the end time as `` float `` seconds since epoch.




## Examples




AsyncMysqlResult is abstract. See specific, concrete classes for examples of ` AsyncMysqlResult::endTime ` (e.g., AsyncMysqlConnectResult, AsyncMysqlErrorResult)







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlResult/endTime/001-basic-usage.php @@
<!-- HHAPIDOC -->
