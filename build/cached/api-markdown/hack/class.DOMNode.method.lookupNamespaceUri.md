``` yamlmeta
{
    "name": "lookupNamespaceUri",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




Gets the namespace URI of the node based on the prefix




``` Hack
public function lookupNamespaceUri(
  mixed $namespaceuri,
): string;
```




## Parameters




+ ` mixed $namespaceuri ` - The prefix of the namespace.




## Returns




* ` mixed ` - - The namespace URI of the node.
<!-- HHAPIDOC -->
