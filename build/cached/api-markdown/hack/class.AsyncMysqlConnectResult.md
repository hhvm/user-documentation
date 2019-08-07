``` yamlmeta
{
    "name": "AsyncMysqlConnectResult",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectResult"
}
```




Provides the result information for when the connection to the MySQL
client is made successfully




This class is instantiated through a call from the connection object
via ` AsyncMysqlConnection::connectResult() `.




## Interface Synopsis




``` Hack
final class AsyncMysqlConnectResult extends AsyncMysqlResult {...}
```




### Public Methods




+ [` ->clientStats(): AsyncMysqlClientStats `](</hack/reference/class/AsyncMysqlConnectResult/clientStats/>)\
  Returns the MySQL client statistics at the moment the connection was
  established
+ [` ->elapsedMicros(): int `](</hack/reference/class/AsyncMysqlConnectResult/elapsedMicros/>)\
  The total time for the establishment of the MySQL connection,
  in microseconds
+ [` ->endTime(): float `](</hack/reference/class/AsyncMysqlConnectResult/endTime/>)\
  The end time of the connection operation, in seconds since epoch
+ [` ->startTime(): float `](</hack/reference/class/AsyncMysqlConnectResult/startTime/>)\
  The start time for the connection operation, in seconds since epoch







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlConnectResult/__construct/>)
<!-- HHAPIDOC -->
