``` yamlmeta
{
    "name": "HH\\set_mem_threshold_callback",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_objprof.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




``` Hack
namespace HH;

function set_mem_threshold_callback(
  int $threshold,
  \mixed $callback,
): \void;
```




## Parameters




+ ` int $threshold `
+ ` \mixed $callback `




## Returns




* ` \void `
<!-- HHAPIDOC -->
