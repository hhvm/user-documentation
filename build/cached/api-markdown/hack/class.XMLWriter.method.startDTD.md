``` yamlmeta
{
    "name": "startDTD",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




``` Hack
public function startDTD(
  string $qualifiedname,
  ?string $publicid = NULL,
  ?string $systemid = NULL,
): bool;
```




## Parameters




+ ` string $qualifiedname `
+ ` ?string $publicid = NULL `
+ ` ?string $systemid = NULL `




## Returns




* ` bool `
<!-- HHAPIDOC -->
