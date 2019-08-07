``` yamlmeta
{
    "name": "HH\\heapgraph_create",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




Capture the current heapgraph







``` Hack
namespace HH;

function heapgraph_create(): \resource;
```




## Returns




+ ` resource ` - - This is the heap graph resource. Use it with other
  heap graph functions to extract the information you want.
<!-- HHAPIDOC -->
