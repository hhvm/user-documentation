``` yamlmeta
{
    "name": "getMethodOrderWithCaching",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




``` Hack
private function getMethodOrderWithCaching(
  ?int $filter,
): Set<string>;
```




## Parameters




+ ` ?int $filter `




## Returns




* ` Set<string> `
<!-- HHAPIDOC -->
