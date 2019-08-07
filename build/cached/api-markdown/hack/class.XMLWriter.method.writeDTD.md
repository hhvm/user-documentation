``` yamlmeta
{
    "name": "writeDTD",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




``` Hack
public function writeDTD(
  string $name,
  ?string $publicid = NULL,
  ?string $systemid = NULL,
  ?string $subset = NULL,
): bool;
```




## Parameters




+ ` string $name `
+ ` ?string $publicid = NULL `
+ ` ?string $systemid = NULL `
+ ` ?string $subset = NULL `




## Returns




* ` bool `
<!-- HHAPIDOC -->
