``` yamlmeta
{
    "name": "writeDTDEntity",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




``` Hack
public function writeDTDEntity(
  string $name,
  string $content,
  bool $pe = false,
  string $publicid = '',
  string $systemid = '',
  string $ndataid = '',
): bool;
```




## Parameters




+ ` string $name `
+ ` string $content `
+ ` bool $pe = false `
+ ` string $publicid = '' `
+ ` string $systemid = '' `
+ ` string $ndataid = '' `




## Returns




* ` bool `
<!-- HHAPIDOC -->
