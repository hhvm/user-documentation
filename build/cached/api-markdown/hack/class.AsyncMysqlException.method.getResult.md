``` yamlmeta
{
    "name": "getResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




Returns the underlying ` AsyncMysqlErrorResult ` associated with the current
exception




``` Hack
public function getResult(): AsyncMysqlErrorResult;
```




## Returns




+ ` AsyncMysqlErrorResult ` - The `` AsyncMysqlErrorResult `` that underlies the current exception.




## Examples




The following example shows how to use ` AsyncMysqlException::getResult ` to get the `` AsyncMysqlErrorResult `` object associated with this exception. Particularly, we call ``` elapsedMicros() ``` on that object.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlException/getResult/001-basic-usage.php @@
<!-- HHAPIDOC -->
