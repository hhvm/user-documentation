``` yamlmeta
{
    "name": "startDocument",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




``` Hack
public function startDocument(
  ?string $version = '1.0',
  ?string $encoding = NULL,
  ?string $standalone = NULL,
): bool;
```




## Parameters




+ ` ?string $version = '1.0' `
+ ` ?string $encoding = NULL `
+ ` ?string $standalone = NULL `




## Returns




* ` bool `
<!-- HHAPIDOC -->
