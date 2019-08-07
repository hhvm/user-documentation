``` yamlmeta
{
    "name": "AsyncMysqlErrorResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlErrorResult"
}
```




Contains error information for a failed operation (e




g., connection, query).




This class is instantiated when an ` AsyncMysqlException ` is thrown and
`` AsyncMysqlException::getResult() `` is called.




## Interface Synopsis




``` Hack
class AsyncMysqlErrorResult extends AsyncMysqlResult {...}
```




### Public Methods




+ [` ->clientStats(): AsyncMysqlClientStats `](</hack/reference/class/AsyncMysqlErrorResult/clientStats/>)\
  Returns the MySQL client statistics for the events that produced the error
+ [` ->elapsedMicros(): int `](</hack/reference/class/AsyncMysqlErrorResult/elapsedMicros/>)\
  The total time for the MySQL error condition to occur, in microseconds
+ [` ->endTime(): float `](</hack/reference/class/AsyncMysqlErrorResult/endTime/>)\
  The end time when the error was produced, in seconds since epoch
+ [` ->failureType(): string `](</hack/reference/class/AsyncMysqlErrorResult/failureType/>)\
  The type of failure that produced this result
+ [` ->mysql_errno(): int `](</hack/reference/class/AsyncMysqlErrorResult/mysql_errno/>)\
  Returns the MySQL error number for this result
+ [` ->mysql_error(): string `](</hack/reference/class/AsyncMysqlErrorResult/mysql_error/>)\
  Returns a human-readable string for the error encountered in this result
+ [` ->mysql_normalize_error(): string `](</hack/reference/class/AsyncMysqlErrorResult/mysql_normalize_error/>)\
  Returns an alternative, normalized version of the error message provided by
  mysql_error()
+ [` ->startTime(): float `](</hack/reference/class/AsyncMysqlErrorResult/startTime/>)\
  The start time when the error was produced, in seconds since epoch







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlErrorResult/__construct/>)
<!-- HHAPIDOC -->
