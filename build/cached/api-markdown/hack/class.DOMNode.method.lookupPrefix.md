``` yamlmeta
{
    "name": "lookupPrefix",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




Gets the namespace prefix of the node based on the namespace URI




``` Hack
public function lookupPrefix(
  string $namespaceURI,
): string;
```




## Parameters




+ ` string $namespaceURI `




## Returns




* ` mixed ` - - The prefix of the namespace.
<!-- HHAPIDOC -->
