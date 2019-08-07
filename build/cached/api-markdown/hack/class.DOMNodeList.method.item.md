``` yamlmeta
{
    "name": "item",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNodeList"
}
```




Retrieves a node specified by index within the DOMNodeList object




``` Hack
public function item(
  int $index,
): Tnode;
```




Tip
If you need to know the number of nodes in the collection, use the length
property of the DOMNodeList object.




## Parameters




+ ` int $index ` - Index of the node into the collection.




## Returns




* ` mixed ` - - The node at the indexth position in the DOMNodeList, or
  NULL if that is not a valid index.
<!-- HHAPIDOC -->
