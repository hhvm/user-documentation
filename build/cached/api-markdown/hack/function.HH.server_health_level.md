``` yamlmeta
{
    "name": "HH\\server_health_level",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Return the health level of the server in the range of 0~100




``` Hack
namespace HH;

function server_health_level(): int;
```




## Returns




+ ` int ` - - 100 if the server is very healthy, and 0 if the
  server should not receive any more request.
<!-- HHAPIDOC -->
