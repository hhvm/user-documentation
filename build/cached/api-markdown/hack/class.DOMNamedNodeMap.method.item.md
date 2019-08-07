``` yamlmeta
{
    "name": "item",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNamedNodeMap"
}
```




Retrieves a node specified by index within the DOMNamedNodeMap object




``` Hack
public function item(
  int $index,
): Tnode;
```




## Parameters




+ ` int $index ` - Index into this map.




## Returns




* ` mixed ` - - The node at the indexth position in the map, or NULL if
  that is not a valid index (greater than or equal to the number of nodes
  in this map).
<!-- HHAPIDOC -->
