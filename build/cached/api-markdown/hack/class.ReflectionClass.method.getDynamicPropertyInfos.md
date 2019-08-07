``` yamlmeta
{
    "name": "getDynamicPropertyInfos",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




``` Hack
private function getDynamicPropertyInfos(
  object $obj,
): array<string, mixed>;
```




## Parameters




+ ` object $obj `




## Returns




* ` array<string, mixed> `
<!-- HHAPIDOC -->
