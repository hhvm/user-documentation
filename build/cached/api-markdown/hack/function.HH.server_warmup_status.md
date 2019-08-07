``` yamlmeta
{
    "name": "HH\\server_warmup_status",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_misc.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_misc.hhi"
    ]
}
```




Returns a (bad) description of the warmup status of the server, based on
request-specific state




``` Hack
namespace HH;

function server_warmup_status(): string;
```




## Returns




+ ` string ` - - If the server appears to be warmed up, returns the empty
  string. Otherwise, returns a human-readable description of why the server is
  not warmed up. Note that this function checks a series of heuristics rather
  than anything definitive; returning '' for one request does not guarantee
  the same result for subsequent requests.
<!-- HHAPIDOC -->
