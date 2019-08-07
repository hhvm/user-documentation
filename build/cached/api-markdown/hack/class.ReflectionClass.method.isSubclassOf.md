``` yamlmeta
{
    "name": "isSubclassOf",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function isSubclassOf(
  mixed $class,
): bool;
```




net/manual/en/reflectionclass.issubclassof.php
)




Checks if the class is a subclass of a specified class or implements a
specified interface.




## Parameters




+ ` mixed $class `




## Returns




* ` bool ` - Returns TRUE on success or FALSE on failure.
<!-- HHAPIDOC -->
