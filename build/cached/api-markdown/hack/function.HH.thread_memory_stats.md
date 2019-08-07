``` yamlmeta
{
    "name": "HH\\thread_memory_stats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_objprof.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




``` Hack
namespace HH;

function thread_memory_stats(): \darray<string, int>;
```




## Returns




+ ` \darray<string, int> `
<!-- HHAPIDOC -->
