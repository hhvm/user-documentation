``` yamlmeta
{
    "name": "AsyncMysqlConnectionOptions",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionOptions"
}
```




This class holds the Connection Options that MySQL client will use to
establish a connection




The ` AsyncMysqlConnectionOptions ` will be passed to
`` AsyncMysqlClient::connectWithOpts() ``.




## Interface Synopsis




``` Hack
class AsyncMysqlConnectionOptions {...}
```




### Public Methods




+ [` ->setConnectAttempts(int $attempts): void `](</hack/reference/class/AsyncMysqlConnectionOptions/setConnectAttempts/>)
+ [` ->setConnectTimeout(int $timeout): void `](</hack/reference/class/AsyncMysqlConnectionOptions/setConnectTimeout/>)
+ [` ->setConnectionAttributes(darray<string> $attrs): void `](</hack/reference/class/AsyncMysqlConnectionOptions/setConnectionAttributes/>)
+ [` ->setQueryTimeout(int $timeout): void `](</hack/reference/class/AsyncMysqlConnectionOptions/setQueryTimeout/>)
+ [` ->setSSLOptionsProvider(?MySSLContextProvider $ssl_context): void `](</hack/reference/class/AsyncMysqlConnectionOptions/setSSLOptionsProvider/>)
+ [` ->setTotalTimeout(int $timeout): void `](</hack/reference/class/AsyncMysqlConnectionOptions/setTotalTimeout/>)
<!-- HHAPIDOC -->
