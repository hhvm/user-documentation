``` yamlmeta
{
    "name": "HH\\heapgraph_dfs_edges",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




performs dfs over the heap graph, starting from the given edges




``` Hack
namespace HH;

function heapgraph_dfs_edges(
  resource $heapgraph,
  array<int> $roots,
  array<int> $skips,
  mixed $callback,
): \void;
```




calls back on every new edge in the scan.




## Parameters




+ ` resource $heapgraph ` - the resource obtained with heapgraph_create
+ ` array<int> $roots ` - edge indexes to start the scan from
+ ` array<int> $skips ` - edge indexes to consider as if they're not there
+ ` mixed $callback ` -
  function(array<string, mixed> $edge, array<string, mixed> $node): void {}
  See documentation for heapgraph_node() about the "node" array passed
  to $callback




## Returns




* ` \void `
<!-- HHAPIDOC -->
