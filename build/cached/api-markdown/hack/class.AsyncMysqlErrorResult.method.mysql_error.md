``` yamlmeta
{
    "name": "mysql_error",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




Returns a human-readable string for the error encountered in this result




``` Hack
public function mysql_error(): string;
```




## Returns




+ ` string ` - The error string.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` mysql_error() ```, which gives you the MySQL error string. In this case, the error string is letting us know that the ```` bogus ```` table does not exist.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/mysql_error/001-basic-usage.php @@
<!-- HHAPIDOC -->
