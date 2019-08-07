``` yamlmeta
{
    "name": "HH\\server_uptime",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Returns the time that the http server has been accepting connections




``` Hack
namespace HH;

function server_uptime(): int;
```




## Returns




+ ` int ` - - number of seconds the server has been running.  -1 if
  server is not started.
<!-- HHAPIDOC -->
