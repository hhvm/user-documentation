``` yamlmeta
{
    "name": "HH\\heapgraph_foreach_edge",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




Iterates over the edges in the heap graph




``` Hack
namespace HH;

function heapgraph_foreach_edge(
  resource $heapgraph,
  mixed $callback,
): \void;
```




Calls back on every edge.




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create
+ ` mixed $callback ` - function(darray<string, mixed> $edge): void {}
  See documentation for heapgraph_edge() about the "edge" array passed
  to $callback




## Returns




* ` \void `
<!-- HHAPIDOC -->
