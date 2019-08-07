``` yamlmeta
{
    "name": "AsyncMysqlClientStats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClientStats"
}
```




Provides timing statistics about the MySQL client




This class provides round-trip and callback timing information for various
operations on the MySQL client.




This information can be used to know how the performance of the MySQL client
may have affected a given result.




For example, if you have a ` AsyncMysqlConnection `, you can call:




` $conn->connectResult()->clientStats()->ioEventLoopMicrosAvg() `




to get round-trip timing information on the connection event itself.




Basically any concrete implementation of ` AsyncMysqlResult ` can provide
these type of statistics by calling its `` clientStats() `` method and a method
on this class.




## Interface Synopsis




``` Hack
class AsyncMysqlClientStats {...}
```




### Public Methods




+ [` ->callbackDelayMicrosAvg(): float `](</hack/reference/class/AsyncMysqlClientStats/callbackDelayMicrosAvg/>)\
  Average delay between when a callback is scheduled in the MySQL client
  and when it's actually ran, in microseconds
+ [` ->ioEventLoopMicrosAvg(): float `](</hack/reference/class/AsyncMysqlClientStats/ioEventLoopMicrosAvg/>)\
  Average loop time of the MySQL client event, in microseconds
+ [` ->ioThreadBusyMicrosAvg(): float `](</hack/reference/class/AsyncMysqlClientStats/ioThreadBusyMicrosAvg/>)\
  Average of reported busy time in the client's IO thread
+ [` ->ioThreadIdleMicrosAvg(): float `](</hack/reference/class/AsyncMysqlClientStats/ioThreadIdleMicrosAvg/>)\
  Average of reported idle time in the client's IO thread
+ [` ->notificationQueueSize(): int `](</hack/reference/class/AsyncMysqlClientStats/notificationQueueSize/>)\
  Size of this client's event base notification queue







### Private Methods




* [` ->__construct(): void `](</hack/reference/class/AsyncMysqlClientStats/__construct/>)
<!-- HHAPIDOC -->
