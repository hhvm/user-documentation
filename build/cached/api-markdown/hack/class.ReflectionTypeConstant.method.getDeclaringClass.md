``` yamlmeta
{
    "name": "getDeclaringClass",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeConstant"
}
```




Gets the declaring class for the reflected type constant




``` Hack
public function getDeclaringClass(): ReflectionClass;
```




This is
the most derived class in which the type constant is declared.




## Returns




+ ` ReflectionClass ` - A ReflectionClass object of the class that the
  reflected type constant is part of.
<!-- HHAPIDOC -->
