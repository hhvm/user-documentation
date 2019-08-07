``` yamlmeta
{
    "name": "AsyncMysqlResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlResult"
}
```




A base class for connection, query and error results




This class is ` abstract ` and cannot be instantiated, but provides the methods
that concrete classes must implement, which are timing information methods
regarding a query, connection or a resulting error.




## Interface Synopsis




``` Hack
abstract class AsyncMysqlResult {...}
```




### Public Methods




+ [` ->clientStats(): AsyncMysqlClientStats `](</hack/reference/class/AsyncMysqlResult/clientStats/>)\
  Returns the MySQL client statistics at the moment the result was created
+ [` ->elapsedMicros(): int `](</hack/reference/class/AsyncMysqlResult/elapsedMicros/>)\
  The total time for the specific MySQL operation, in microseconds
+ [` ->endTime(): float `](</hack/reference/class/AsyncMysqlResult/endTime/>)\
  The end time for the specific MySQL operation, in seconds since epoch
+ [` ->startTime(): float `](</hack/reference/class/AsyncMysqlResult/startTime/>)\
  The start time for the specific MySQL operation, in seconds since epoch







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlResult/__construct/>)
<!-- HHAPIDOC -->
