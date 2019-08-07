``` yamlmeta
{
    "name": "insertBefore",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




This function inserts a new node right before the reference node




``` Hack
public function insertBefore<T as DOMNode>(
  DOMNode $newnode,
  DOMNode $refnode = NULL,
): T;
```




If you
plan to do further modifications on the appended child you must use the
returned node.




## Parameters




+ ` DOMNode $newnode ` - The new node.
+ ` DOMNode $refnode = NULL ` - The reference node. If not supplied, newnode is
  appended to the children.




## Returns




* ` mixed ` - - The inserted node.
<!-- HHAPIDOC -->
