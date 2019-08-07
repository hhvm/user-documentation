``` yamlmeta
{
    "name": "getLineNo",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




Gets line number for where the node is defined




``` Hack
public function getLineNo(): int;
```




## Returns




+ ` int ` - - Always returns the line number where the node was defined
  in.
<!-- HHAPIDOC -->
