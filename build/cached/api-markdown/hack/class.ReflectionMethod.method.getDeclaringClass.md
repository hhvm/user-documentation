``` yamlmeta
{
    "name": "getDeclaringClass",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from
http://php




``` Hack
public function getDeclaringClass();
```




net/manual/en/reflectionmethod.getdeclaringclass.php )




Gets the declaring class for the reflected method.




## Returns




+ ` ReflectionClass ` - A ReflectionClass object of the class that the
  reflected method is part of.
<!-- HHAPIDOC -->
