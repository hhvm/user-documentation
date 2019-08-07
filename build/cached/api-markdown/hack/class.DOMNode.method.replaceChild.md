``` yamlmeta
{
    "name": "replaceChild",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




This function replaces the child oldnode with the passed new node




``` Hack
public function replaceChild<T as DOMNode>(
  DOMNode $newchildobj,
  DOMNode $oldchildobj,
): T;
```




If the
new node is already a child it will not be added a second time. If the
replacement succeeds the old node is returned.




## Parameters




+ ` DOMNode $newchildobj ` - The new node. It must be a member of the
  target document, i.e. created by one of the DOMDocument->createXXX()
  methods or imported in the document by DOMDocument::importNode.
+ ` DOMNode $oldchildobj ` - The old node.




## Returns




* ` mixed ` - - The old node or FALSE if an error occur.
<!-- HHAPIDOC -->
