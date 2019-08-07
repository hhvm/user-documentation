``` yamlmeta
{
    "name": "setSSLOptionsProvider",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnectionOptions"
}
```




``` Hack
public function setSSLOptionsProvider(
  ?MySSLContextProvider $ssl_context,
): void;
```




## Parameters




+ ` ?MySSLContextProvider $ssl_context `




## Returns




* ` void `
<!-- HHAPIDOC -->
