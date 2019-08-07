``` yamlmeta
{
    "name": "hasMethod",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function hasMethod(
  string $name,
): bool;
```




net/manual/en/reflectionclass.hasmethod.php )




Checks whether a specific method is defined in a class.




## Parameters




+ ` string $name `




## Returns




* ` bool ` - TRUE if it has the method, otherwise FALSE
<!-- HHAPIDOC -->
