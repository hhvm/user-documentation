``` yamlmeta
{
    "name": "getAttributeClass",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




``` Hack
final public function getAttributeClass<T as HH\ParameterAttribute>(
  classname<T> $c,
): ?T;
```




## Parameters




+ ` classname<T> $c `




## Returns




* ` ?T `
<!-- HHAPIDOC -->
