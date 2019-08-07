``` yamlmeta
{
    "name": "getInterfaces",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from
http://php




``` Hack
public function getInterfaces(): darray<string, ReflectionClass>;
```




net/manual/en/reflectionclass.getinterfaces.php )




Gets the interfaces.




## Returns




+ ` mixed ` - An associative array of interfaces, with keys as
  interface names and the array values as
  ReflectionClass objects.
<!-- HHAPIDOC -->
