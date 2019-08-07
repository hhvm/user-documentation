``` yamlmeta
{
    "name": "getOrderedAbstractConstants",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




``` Hack
private static function getOrderedAbstractConstants(
  string $clsname,
): darray<string, string>;
```




## Parameters




+ ` string $clsname `




## Returns




* ` darray<string, string> `
<!-- HHAPIDOC -->
