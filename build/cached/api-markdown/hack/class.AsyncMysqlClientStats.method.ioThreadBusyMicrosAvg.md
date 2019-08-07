``` yamlmeta
{
    "name": "ioThreadBusyMicrosAvg",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClientStats"
}
```




Average of reported busy time in the client's IO thread




``` Hack
public function ioThreadBusyMicrosAvg(): float;
```




This returns an exponentially-smoothed average.




## Returns




+ ` float ` - A `` float `` representing the average busy time of this
  MySQL client's IO Thread.
<!-- HHAPIDOC -->
