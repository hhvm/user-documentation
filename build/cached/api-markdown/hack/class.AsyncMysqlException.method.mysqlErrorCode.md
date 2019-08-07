``` yamlmeta
{
    "name": "mysqlErrorCode",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql_exceptions.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlException"
}
```




Returns the MySQL error number for that caused the current exception




``` Hack
public function mysqlErrorCode(): int;
```




See MySQL's
[mysql_errno()](<http://dev.mysql.com/doc/refman/5.0/en/mysql-errno.html>)
for information on the error numbers.




## Returns




+ ` int ` - The error number as an `` int ``.




## Examples




The following example shows how to use ` AsyncMysqlException::mysqlErrorCode ` to get the raw MySQL error code associated with this exception. The most likely error code for this example will be `` 1045 `` for access denied.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlException/mysqlErrorCode/001-basic-usage.php @@
<!-- HHAPIDOC -->
