``` yamlmeta
{
    "name": "C14NFile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




``` Hack
public function C14NFile(
  string $uri,
  bool $exclusive = false,
  bool $with_comments = false,
  ?darray $xpath = NULL,
  ?varray $ns_prefixes = NULL,
): int;
```




## Parameters




+ ` string $uri `
+ ` bool $exclusive = false `
+ ` bool $with_comments = false `
+ ` ?darray $xpath = NULL `
+ ` ?varray $ns_prefixes = NULL `




## Returns




* ` int `
<!-- HHAPIDOC -->
