``` yamlmeta
{
    "name": "cloneNode",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




Creates a copy of the node




``` Hack
public function cloneNode(
  bool $deep = false,
): this;
```




## Parameters




+ ` bool $deep = false ` - Indicates whether to copy all descendant nodes. This
  parameter is defaulted to FALSE.




## Returns




* ` mixed ` - - The cloned node.
<!-- HHAPIDOC -->
