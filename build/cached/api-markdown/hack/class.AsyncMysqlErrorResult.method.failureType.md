``` yamlmeta
{
    "name": "failureType",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




The type of failure that produced this result




``` Hack
public function failureType(): string;
```




The string returned will be either ` 'TimedOut' `, representing a timeout, or
`` 'Failed' ``, representing the server rejecting the connection or query.




## Returns




+ ` string ` - the type of failure, either `` 'TimedOut' `` or ``` 'Failed' ```.




## Examples




When an error occurs when establishing a connection or on a query, and you catch the exception that is thrown, you will get an ` AsyncMysqlErrorResult `. And one of the methods on an `` AsyncMysqlErrorResult `` is ``` failureType() ```, which tells you whether the operation was a timeout (via the string ```` TimedOut ````) or a server rejection of our connection or query (via the string ````` Failed `````).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlErrorResult/failureType/001-basic-usage.php @@
<!-- HHAPIDOC -->
