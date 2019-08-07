``` yamlmeta
{
    "name": "writeElementNS",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




``` Hack
public function writeElementNS(
  ?string $prefix,
  string $name,
  ?string $uri,
  ?string $content = NULL,
): bool;
```




## Parameters




+ ` ?string $prefix `
+ ` string $name `
+ ` ?string $uri `
+ ` ?string $content = NULL `




## Returns




* ` bool `
<!-- HHAPIDOC -->
