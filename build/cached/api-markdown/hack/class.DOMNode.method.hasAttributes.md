``` yamlmeta
{
    "name": "hasAttributes",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




This method checks if the node has attributes




``` Hack
public function hasAttributes(): bool;
```




The tested node have to be
an XML_ELEMENT_NODE.




## Returns




+ ` bool ` - - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
