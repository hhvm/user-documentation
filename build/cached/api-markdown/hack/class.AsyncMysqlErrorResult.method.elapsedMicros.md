``` yamlmeta
{
    "name": "elapsedMicros",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




The total time for the MySQL error condition to occur, in microseconds




``` Hack
public function elapsedMicros(): int;
```




## Returns




+ ` int ` - the total error producing time as `` int `` microseconds.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` elapsedMicros() ```, which tells you how long the operation took until the error occurred.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/elapsedMicros/001-basic-usage.php @@
<!-- HHAPIDOC -->
