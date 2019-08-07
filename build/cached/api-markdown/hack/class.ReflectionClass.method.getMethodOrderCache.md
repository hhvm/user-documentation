``` yamlmeta
{
    "name": "getMethodOrderCache",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




``` Hack
private static function getMethodOrderCache(
  string $clsname,
): Set<string>;
```




## Parameters




+ ` string $clsname `




## Returns




* ` Set<string> `
<!-- HHAPIDOC -->
