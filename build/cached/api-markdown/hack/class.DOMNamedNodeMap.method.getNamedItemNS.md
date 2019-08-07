``` yamlmeta
{
    "name": "getNamedItemNS",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNamedNodeMap"
}
```




Retrieves a node specified by localName and namespaceURI




``` Hack
public function getNamedItemNS(
  string $namespaceuri,
  string $localname,
): Tnode;
```




## Parameters




+ ` string $namespaceuri ` - The namespace URI of the node to retrieve.
+ ` string $localname ` - The local name of the node to retrieve.




## Returns




* ` mixed ` - - A node (of any type) with the specified local name and
  namespace URI, or NULL if no node is found.
<!-- HHAPIDOC -->
