``` yamlmeta
{
    "name": "DOMNamedNodeMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNamedNodeMap"
}
```




## Interface Synopsis




``` Hack
class DOMNamedNodeMap implements IteratorAggregate, KeyedTraversable {...}
```




### Public Methods




+ [` ->__construct(): void `](</hack/reference/class/DOMNamedNodeMap/__construct/>)
+ [` ->getIterator(): mixed `](</hack/reference/class/DOMNamedNodeMap/getIterator/>)
+ [` ->getNamedItem(string $name): Tnode `](</hack/reference/class/DOMNamedNodeMap/getNamedItem/>)\
  Retrieves a node specified by its nodeName
+ [` ->getNamedItemNS(string $namespaceuri, string $localname): Tnode `](</hack/reference/class/DOMNamedNodeMap/getNamedItemNS/>)\
  Retrieves a node specified by localName and namespaceURI
+ [` ->item(int $index): Tnode `](</hack/reference/class/DOMNamedNodeMap/item/>)\
  Retrieves a node specified by index within the DOMNamedNodeMap object
<!-- HHAPIDOC -->
