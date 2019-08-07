``` yamlmeta
{
    "name": "HH\\heapgraph_foreach_root",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




Iterates over the root edges in the heap graph




``` Hack
namespace HH;

function heapgraph_foreach_root(
  resource $heapgraph,
  mixed $callback,
): \void;
```




Calls back on every root
edge. The "from" field of each root edge will be root node. root nodes
are also enumerable by calling heapgraph_foreach_root_node().




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create
+ ` mixed $callback ` - function(darray<string, mixed> $edge): void {}
  See documentation for heapgraph_edge() about the "edge" array passed
  to $callback




## Returns




* ` \void `
<!-- HHAPIDOC -->
