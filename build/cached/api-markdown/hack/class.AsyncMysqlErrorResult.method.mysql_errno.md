``` yamlmeta
{
    "name": "mysql_errno",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




Returns the MySQL error number for this result




``` Hack
public function mysql_errno(): int;
```




See MySQL's
[mysql_errno()](<http://dev.mysql.com/doc/refman/5.0/en/mysql-errno.html>)
for information on the error numbers.




## Returns




+ ` int ` - The error number as an `` int ``.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` mysql_errno() ```, which gives you the MySQL error number. In this case, the error number is 1146, which represents a table not existing.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/mysql_errno/001-basic-usage.php @@
<!-- HHAPIDOC -->
