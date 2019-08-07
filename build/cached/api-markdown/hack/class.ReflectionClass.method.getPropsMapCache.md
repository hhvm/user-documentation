``` yamlmeta
{
    "name": "getPropsMapCache",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




``` Hack
private static function getPropsMapCache(
  string $clsname,
): ImmMap<string, mixed>;
```




## Parameters




+ ` string $clsname `




## Returns




* ` ImmMap<string, mixed> `
<!-- HHAPIDOC -->
