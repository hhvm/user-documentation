``` yamlmeta
{
    "name": "HH\\server_process_start_time",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Returns the timestamp when the http server process was started




``` Hack
namespace HH;

function server_process_start_time(): int;
```




## Returns




+ ` int ` - - number of seconds since epoch when process started.  0 if
  server is not started.
<!-- HHAPIDOC -->
