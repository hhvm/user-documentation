``` yamlmeta
{
    "name": "HH\\objprof_get_data",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_objprof.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




``` Hack
namespace HH;

function objprof_get_data(
  int $flags = \OBJPROF_FLAGS_DEFAULT,
  \varray<string> $exclude_list = array (
),
): \darray<string, ObjprofObjectStats>;
```




## Parameters




+ ` int $flags = \OBJPROF_FLAGS_DEFAULT `
+ ` \varray<string> $exclude_list = array ( ) `




## Returns




* ` \darray<string, ObjprofObjectStats> `
<!-- HHAPIDOC -->
