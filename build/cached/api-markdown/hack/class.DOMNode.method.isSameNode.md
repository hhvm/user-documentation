``` yamlmeta
{
    "name": "isSameNode",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




This function indicates if two nodes are the same node




``` Hack
public function isSameNode(
  DOMNode $node,
): bool;
```




The comparison is
not based on content




## Parameters




+ ` DOMNode $node ` - The compared node.




## Returns




* ` bool ` - - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
