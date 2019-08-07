``` yamlmeta
{
    "name": "HH\\server_is_stopping",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Whether the server is going to stop soon




``` Hack
namespace HH;

function server_is_stopping(): bool;
```




## Returns




+ ` bool ` - - True if server is going to stop soon, False if
  server is not running, or is running without a schedule to stop.
<!-- HHAPIDOC -->
