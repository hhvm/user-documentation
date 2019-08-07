``` yamlmeta
{
    "name": "c14n",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




``` Hack
public function c14n(
  bool $exclusive = false,
  bool $with_comments = false,
  mixed $xpath = NULL,
  mixed $ns_prefixes = NULL,
): mixed;
```




## Parameters




+ ` bool $exclusive = false `
+ ` bool $with_comments = false `
+ ` mixed $xpath = NULL `
+ ` mixed $ns_prefixes = NULL `




## Returns




* ` mixed `
<!-- HHAPIDOC -->
