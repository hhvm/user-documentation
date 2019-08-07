``` yamlmeta
{
    "name": "isDefaultNamespace",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




Tells whether namespaceURI is the default namespace




``` Hack
public function isDefaultNamespace(
  string $namespaceuri,
): bool;
```




## Parameters




+ ` string $namespaceuri ` - The namespace URI to look for.




## Returns




* ` bool ` - - Return TRUE if namespaceURI is the default namespace,
  FALSE otherwise.
<!-- HHAPIDOC -->
