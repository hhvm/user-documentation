``` yamlmeta
{
    "name": "failed",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




Returns whether the type of failure that produced the exception was a
general connection or query failure




``` Hack
public function failed(): bool;
```




An ` AsyncMysqlErrorResult ` can occur due to `` 'TimedOut' ``, representing a
timeout, or ``` 'Failed' ```, representing the server rejecting the connection
or query.




## Returns




+ ` bool ` - `` true `` if the type of failure was a general failure; ``` false ```
  otherwise.




## Examples




The following example shows how to use ` AsyncMysqlException::failed ` to determine if the connection failed in some other way than a timeout.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlException/failed/001-basic-usage.php @@
<!-- HHAPIDOC -->
