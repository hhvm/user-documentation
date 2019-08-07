``` yamlmeta
{
    "name": "numSuccessfulQueries",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryErrorResult"
}
```




Returns the number of successfully executed queries




``` Hack
public function numSuccessfulQueries(): int;
```




If there were any successful queries before receiving the error, this will
let you know how many of those there were.




## Returns




+ ` int ` - The number of successful queries before the error as an `` int ``.




## Examples




This example shows how we can get the number of successful queries of a multi-query, even though one of those queries gave us an error (which we caught in the exception). This is done via ` AsyncMysqlQueryErrorResult::numSuccessfulQueries `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryErrorResult/numSuccessfulQueries/001-basic-usage.php @@
<!-- HHAPIDOC -->
