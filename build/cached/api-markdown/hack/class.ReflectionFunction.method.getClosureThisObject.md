``` yamlmeta
{
    "name": "getClosureThisObject",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




``` Hack
private function getClosureThisObject(
  object $closure,
): ?object;
```




## Parameters




+ ` object $closure `




## Returns




* ` ?object `
<!-- HHAPIDOC -->
