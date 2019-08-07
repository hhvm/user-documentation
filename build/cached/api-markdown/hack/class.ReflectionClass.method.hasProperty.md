``` yamlmeta
{
    "name": "hasProperty",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function hasProperty(
  string $name,
): bool;
```




net/manual/en/reflectionclass.hasproperty.php
)




Checks whether the specified property is defined.




## Parameters




+ ` string $name `




## Returns




* ` bool ` - TRUE if it has the property, otherwise FALSE
<!-- HHAPIDOC -->
