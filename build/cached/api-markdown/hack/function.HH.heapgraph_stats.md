``` yamlmeta
{
    "name": "HH\\heapgraph_stats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




General statistics on the heap graph







``` Hack
namespace HH;

function heapgraph_stats(
  resource $heapgraph,
): \darray<string, int>;
```




## Parameters




+ ` resource $heapgraph ` - The resource obtained with heapgraph_create




## Returns




* ` array<string, ` - int> - General metrics describing the heap graph.
  Keys are defined as follows:




nodes      count of nodes in the graph
edges      count of pointers (edges) in the graph
roots      count of root->nonroot pointers (pointers where from is root)
root_nodes count of root nodes
exact      1 if type scanners were built, 0 otherwise
<!-- HHAPIDOC -->
