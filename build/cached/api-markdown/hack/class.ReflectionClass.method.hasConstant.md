``` yamlmeta
{
    "name": "hasConstant",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function hasConstant(
  string $name,
): bool;
```




net/manual/en/reflectionclass.hasconstant.php
)




Checks whether the class has a specific constant defined or not.




## Parameters




+ ` string $name `




## Returns




* ` bool ` - TRUE if the constant is defined, otherwise FALSE.
<!-- HHAPIDOC -->
