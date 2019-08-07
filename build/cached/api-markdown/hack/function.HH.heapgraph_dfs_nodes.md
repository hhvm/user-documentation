``` yamlmeta
{
    "name": "HH\\heapgraph_dfs_nodes",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_prof.hhi"
    ]
}
```




performs dfs over the heap graph, starting from the given nodes




``` Hack
namespace HH;

function heapgraph_dfs_nodes(
  resource $heapgraph,
  array<int> $roots,
  array<int> $skips,
  mixed $callback,
): \void;
```




calls back on every new node in the scan.




## Parameters




+ ` resource $heapgraph ` - the resource obtained with heapgraph_create
+ ` array<int> $roots ` - node indexes to start the scan from
+ ` array<int> $skips ` - node indexes to consider as if they're not there
+ ` mixed $callback ` - function(array<string, mixed> $node): void {}
  See documentation for heapgraph_edge() about the "edge" array passed
  to $callback




## Returns




* ` \void `
<!-- HHAPIDOC -->
