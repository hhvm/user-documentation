``` yamlmeta
{
    "name": "removeChild",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




This functions removes a child from a list of children




``` Hack
public function removeChild(
  DOMNode $node,
): DOMNode;
```




## Parameters




+ ` DOMNode $node ` - The removed child.




## Returns




* ` mixed ` - - If the child could be removed the functions returns the
  old child.
<!-- HHAPIDOC -->
