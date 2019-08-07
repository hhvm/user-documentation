``` yamlmeta
{
    "name": "sslSessionReused",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/async_mysql/ext_async_mysql.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_async_mysql.hhi"
    ],
    "class": "AsyncMysqlConnection"
}
```




Returns whether or not the current connection reused the SSL session
from another SSL connection




``` Hack
public function sslSessionReused(): bool;
```




The session is set by MySSLContextProvider.
Some cases, the server can deny the session that was set and the handshake
will create a new one, in those cases this function will return ` false `.
If this connections isn't SSL, `` false `` will be returned as well.




## Returns




+ ` bool ` - `` true `` if this is a SSL connection and the SSL session was
  reused; ``` false ``` otherwise.
<!-- HHAPIDOC -->
