``` yamlmeta
{
    "name": "getModifiers",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getModifiers(): int;
```




net/manual/en/reflectionclass.getmodifiers.php
)




Returns a bitfield of the access modifiers for this class.




## Returns




+ ` int ` - Returns bitmask of modifier constants.
<!-- HHAPIDOC -->
