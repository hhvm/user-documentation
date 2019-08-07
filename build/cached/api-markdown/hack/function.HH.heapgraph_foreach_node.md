``` yamlmeta
{
    "name": "HH\\heapgraph_foreach_node",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




Iterates over the nodes in the heap graph




``` Hack
namespace HH;

function heapgraph_foreach_node(
  resource $heapgraph,
  mixed $callback,
): \void;
```




Calls back on every node.




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create
+ ` mixed $callback ` - function(array<string, mixed> $node): void {}
  See documentation for heapgraph_node() about the "node" array passed
  to $callback




## Returns




* ` \void `
<!-- HHAPIDOC -->
