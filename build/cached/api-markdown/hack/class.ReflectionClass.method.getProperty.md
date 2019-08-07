``` yamlmeta
{
    "name": "getProperty",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getProperty(
  string $name,
): ReflectionProperty;
```




net/manual/en/reflectionclass.getproperty.php
)




Gets a ReflectionProperty for a class's property.




## Parameters




+ ` string $name `




## Returns




* ` mixed ` - A ReflectionProperty.
<!-- HHAPIDOC -->
