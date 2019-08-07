``` yamlmeta
{
    "name": "HH\\heapgraph_edge",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




Get a specific edge (pointer) from the heap graph







``` Hack
namespace HH;

function heapgraph_edge(
  resource $heapgraph,
  int $index,
): \darray<string, \mixed>;
```




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create
+ ` int $index ` - The edge index




## Returns




* ` array<string, ` - mixed> The requested edge, with these fields:




index    the edge id == $index
kind     Counted, Implicit, or Ambiguous
from     node id owning the pointer
to       node id of the node pointed to




If the from node is an array:
key      num; this pointer is the num'th key in iterator order (0..)
value    num; pointer is the num'th value in iter order




if the from node is an object:
prop     declared property name of the pointer




optionally, the pointer may be unclassified, but with a known offset:
offset   byte-offset of the pointer within the from node.
<!-- HHAPIDOC -->
