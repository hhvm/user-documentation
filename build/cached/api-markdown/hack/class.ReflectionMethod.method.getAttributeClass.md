``` yamlmeta
{
    "name": "getAttributeClass",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




``` Hack
final public function getAttributeClass<T as HH\MethodAttribute>(
  classname<T> $c,
): ?T;
```




## Parameters




+ ` classname<T> $c `




## Returns




* ` ?T `
<!-- HHAPIDOC -->
