``` yamlmeta
{
    "name": "notificationQueueSize",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlClientStats"
}
```




Size of this client's event base notification queue




``` Hack
public function notificationQueueSize(): int;
```




Value is collected at the end of the operation.




## Returns




+ ` int ` - A `` int `` representing the size of notification queue of this
  MySQL client's IO Thread.
<!-- HHAPIDOC -->
