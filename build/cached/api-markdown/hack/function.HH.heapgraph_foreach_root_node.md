``` yamlmeta
{
    "name": "HH\\heapgraph_foreach_root_node",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php"
    ]
}
```




Iterates over the root nodes in the heap graph




``` Hack
namespace HH;

function heapgraph_foreach_root_node(
  resource $heapgraph,
  mixed $callback,
): \void;
```




Calls back on every root
node. Out-edges from root nodes are also enumerable separately by calling
heapgraph_foreach_root().




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create
+ ` mixed $callback ` - function(darray<string, mixed> $node): void {}
  See documentation for heapgraph_node() about the "node" array passed
  to $callback




## Returns




* ` \void `
<!-- HHAPIDOC -->
