``` yamlmeta
{
    "name": "C14N",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




``` Hack
public function C14N(
  bool $exclusive = false,
  bool $with_comments = false,
  ?darray $xpath = NULL,
  ?varray $ns_prefixes = NULL,
): string;
```




## Parameters




+ ` bool $exclusive = false `
+ ` bool $with_comments = false `
+ ` ?darray $xpath = NULL `
+ ` ?varray $ns_prefixes = NULL `




## Returns




* ` string `
<!-- HHAPIDOC -->
