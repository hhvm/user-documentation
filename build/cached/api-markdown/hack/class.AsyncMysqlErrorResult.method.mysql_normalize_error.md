``` yamlmeta
{
    "name": "mysql_normalize_error",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




Returns an alternative, normalized version of the error message provided by
mysql_error()




``` Hack
public function mysql_normalize_error(): string;
```




Sometimes the message is the same, depending on if there was an explicit
normalized string provided by the MySQL client.




## Returns




+ ` string ` - The normalized error string.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` mysql_normalize_error() ```, which gives you possibly alternative, normalized version of the error provided by ```` mysql_error() ````. Many times they are the same; it depends on how the client provides the error messages. In this case, the two errors are the same; the error string is letting us know that the ````` bogus ````` table does not exist.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/mysql_normalize_error/001-basic-usage.php @@
<!-- HHAPIDOC -->
