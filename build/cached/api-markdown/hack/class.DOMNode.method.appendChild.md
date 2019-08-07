``` yamlmeta
{
    "name": "appendChild",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




This functions appends a child to an existing list of children or creates
a new list of children




``` Hack
public function appendChild<T as DOMNode>(
  DOMNode $newnode,
): T;
```




The child can be created with e.g.
DOMDocument::createElement(), DOMDocument::createTextNode() etc. or
simply by using any other node.




## Parameters




+ ` DOMNode $newnode ` - The appended child.




## Returns




* ` mixed ` - - The node added.
<!-- HHAPIDOC -->
