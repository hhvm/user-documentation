``` yamlmeta
{
    "name": "AsyncMysqlQueryErrorResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlQueryErrorResult"
}
```




Contains the information about results for query statements that ran before
a MySQL error




This class is instantiated when an ` AsyncMysqlQueryException ` is thrown and
`` AsyncMysqlQueryException::getResult() `` is called.




## Interface Synopsis




``` Hack
final class AsyncMysqlQueryErrorResult extends AsyncMysqlErrorResult {...}
```




### Public Methods




+ [` ->getSuccessfulResults(): Vector<AsyncMysqlQueryResult> `](</hack/reference/class/AsyncMysqlQueryErrorResult/getSuccessfulResults/>)\
  Returns the results that were fetched by the successful query statements
+ [` ->numSuccessfulQueries(): int `](</hack/reference/class/AsyncMysqlQueryErrorResult/numSuccessfulQueries/>)\
  Returns the number of successfully executed queries







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlQueryErrorResult/__construct/>)
<!-- HHAPIDOC -->
