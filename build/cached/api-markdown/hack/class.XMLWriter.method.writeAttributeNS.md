``` yamlmeta
{
    "name": "writeAttributeNS",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




``` Hack
public function writeAttributeNS(
  string $prefix,
  string $name,
  string $uri,
  string $content,
): bool;
```




## Parameters




+ ` string $prefix `
+ ` string $name `
+ ` string $uri `
+ ` string $content `




## Returns




* ` bool `
<!-- HHAPIDOC -->
