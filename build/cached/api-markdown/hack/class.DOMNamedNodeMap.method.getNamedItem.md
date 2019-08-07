``` yamlmeta
{
    "name": "getNamedItem",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNamedNodeMap"
}
```




Retrieves a node specified by its nodeName




``` Hack
public function getNamedItem(
  string $name,
): Tnode;
```




## Parameters




+ ` string $name ` - The nodeName of the node to retrieve.




## Returns




* ` mixed ` - - A node (of any type) with the specified nodeName, or NULL
  if no node is found.
<!-- HHAPIDOC -->
