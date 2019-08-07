``` yamlmeta
{
    "name": "getClass",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeConstant"
}
```




Gets the class for the reflected type constant




``` Hack
public function getClass(): ReflectionClass;
```




## Returns




+ ` ReflectionClass ` - A ReflectionClass object of the class that the
  reflected type constant is part of.
<!-- HHAPIDOC -->
