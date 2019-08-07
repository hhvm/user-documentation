``` yamlmeta
{
    "name": "getSuccessfulResults",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryErrorResult"
}
```




Returns the results that were fetched by the successful query statements




``` Hack
public function getSuccessfulResults(): Vector<AsyncMysqlQueryResult>;
```




## Returns




+ ` Vector<AsyncMysqlQueryResult> ` - A `` Vector `` of ``` AsyncMysqlQueryResult ``` objects for each result
  produced by a successful query statement.




## Examples




This example shows how we can get the successful results of a multi-query, even though one of those queries gave us an error (which we caught in the exception). This is done via ` AsyncMysqlQueryErrorResult::getSuccessfulResults `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.AsyncMysqlQueryErrorResult/getSuccessfulResults/001-basic-usage.php @@
<!-- HHAPIDOC -->
