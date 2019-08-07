``` yamlmeta
{
    "name": "getAbstractConstantNames",
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
public function getAbstractConstantNames(): darray<string>;
```




net/manual/en/reflectionclass.getabstractconstantnames.php
)




Returns an array containing the names of abstract constants as both
keys and values.




## Returns




+ ` array<string, ` - string>
<!-- HHAPIDOC -->
