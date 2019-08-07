``` yamlmeta
{
    "name": "HH\\server_warmup_status_monotonic",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_misc.php"
    ]
}
```




Returns a good description of the warmup status of the server, based on
process-global state




``` Hack
namespace HH;

function server_warmup_status_monotonic(): string;
```




## Returns




+ ` string ` - - If the server appears to be warmed up, returns the empty
  string. Otherwise, returns a human-readable description of why the server is
  not warmed up. Unlike server_warmup_status(), this function is monotonic,
  i.e., once it returns empty string, it will keep returning empty string.
<!-- HHAPIDOC -->
