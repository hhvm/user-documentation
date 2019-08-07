``` yamlmeta
{
    "name": "getMethods",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getMethods(
  ?int $filter = NULL,
): varray<ReflectionMethod>;
```




net/manual/en/reflectionclass.getmethods.php )




Gets an array of methods for the class.




## Parameters




+ ` ?int $filter = NULL `




## Returns




* ` mixed ` - An array of ReflectionMethod objects reflecting each
  method.
<!-- HHAPIDOC -->
