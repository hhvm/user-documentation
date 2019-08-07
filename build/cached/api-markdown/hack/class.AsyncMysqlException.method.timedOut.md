``` yamlmeta
{
    "name": "timedOut",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




Returns whether the type of failure that produced the exception was a
timeout




``` Hack
public function timedOut(): bool;
```




An ` AsyncMysqlErrorResult ` can occur due to `` 'TimedOut' ``, representing a
timeout, or ``` 'Failed' ```, representing the server rejecting the connection
or query.




## Returns




+ ` bool ` - `` true `` if the type of failure was a time out; ``` false ``` otherwise.




## Examples




The following example shows how to use ` AsyncMysqlException::timedOut ` to determine if the connection failed by a timeout.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlException/timedOut/001-basic-usage.php @@
<!-- HHAPIDOC -->
