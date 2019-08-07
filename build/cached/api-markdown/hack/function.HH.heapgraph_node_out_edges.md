``` yamlmeta
{
    "name": "HH\\heapgraph_node_out_edges",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




Get an array of outgoing edges from a specific node from the heap graph







``` Hack
namespace HH;

function heapgraph_node_out_edges(
  resource $heapgraph,
  int $index,
): \varray<\darray<string, \mixed>>;
```




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create
+ ` int $index ` - The node index




## Returns




* ` array<array<string, ` - mixed>> The outgoing edges
  See documentation for heapgraph_edge() about the "edge" array passed
  to $callback
<!-- HHAPIDOC -->
