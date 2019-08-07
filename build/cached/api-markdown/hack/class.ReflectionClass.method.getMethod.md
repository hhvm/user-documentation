``` yamlmeta
{
    "name": "getMethod",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getMethod(
  string $name,
): ReflectionMethod;
```




net/manual/en/reflectionclass.getmethod.php )




Gets a ReflectionMethod for a class method.




## Parameters




+ ` string $name `




## Returns




* ` mixed ` - A ReflectionMethod.
<!-- HHAPIDOC -->
