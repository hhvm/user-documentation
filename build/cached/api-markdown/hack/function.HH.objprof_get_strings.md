``` yamlmeta
{
    "name": "HH\\objprof_get_strings",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_objprof.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




``` Hack
namespace HH;

function objprof_get_strings(
  int $min_dup,
): \darray<string, ObjprofStringStats>;
```




## Parameters




+ ` int $min_dup `




## Returns




* ` \darray<string, ObjprofStringStats> `
<!-- HHAPIDOC -->
