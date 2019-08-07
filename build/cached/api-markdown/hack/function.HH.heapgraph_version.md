``` yamlmeta
{
    "name": "HH\\heapgraph_version",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/objprof/ext_heapgraph.php"
    ]
}
```




Return an integer describing the current format of stats, nodes,
and edges




``` Hack
namespace HH;

function heapgraph_version(): int;
```




This will be incremented when things change substantially
enough to require client detection




## Returns




+ ` int `
<!-- HHAPIDOC -->
