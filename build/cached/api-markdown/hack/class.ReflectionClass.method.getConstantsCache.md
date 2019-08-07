``` yamlmeta
{
    "name": "getConstantsCache",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




``` Hack
private static function getConstantsCache(
  string $clsname,
): darray<string, mixed>;
```




## Parameters




+ ` string $clsname `




## Returns




* ` darray<string, mixed> `
<!-- HHAPIDOC -->
