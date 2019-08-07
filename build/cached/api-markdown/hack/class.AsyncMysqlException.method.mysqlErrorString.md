``` yamlmeta
{
    "name": "mysqlErrorString",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




Returns a human-readable string for the error encountered in the current
exception




``` Hack
public function mysqlErrorString(): string;
```




## Returns




+ ` string ` - The error string.




## Examples




The following example shows how to use ` AsyncMysqlException::mysqlErrorString ` to get the raw MySQL error string associated with this exception. For this example, the most likely exception string will be something like:




```
Access denied for user 'testuser'@'localhost' (using password: YES)
```







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlException/mysqlErrorString/001-basic-usage.php @@
<!-- HHAPIDOC -->
