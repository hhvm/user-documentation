``` yamlmeta
{
    "name": "isSSL",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Returns whether or not the current connection was established as SSL based
on client flag exchanged during handshake




``` Hack
public function isSSL(): bool;
```




## Returns




+ ` bool ` - `` true `` if this is a SSL connection; ``` false ``` otherwise
<!-- HHAPIDOC -->
