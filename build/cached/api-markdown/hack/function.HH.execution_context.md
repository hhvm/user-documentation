``` yamlmeta
{
    "name": "HH\\execution_context",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_misc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_misc.hhi"
    ]
}
```




Returns a description of the context in which the request is executing




``` Hack
namespace HH;

function execution_context(): string;
```




## Returns




+ ` string ` - - If the request was initiated via the proxygen, xbox,
  pagelet, fastcgi, or replay servers those values are returned. In client
  mode the string cli is returned, when executing in client mode on a server
  (via the unix socket interface) clisrv is returned. On the server with an
  unknown context the string "worker" is returned indicating the job was run
  on an unnamed JobQueue within the server.
<!-- HHAPIDOC -->
