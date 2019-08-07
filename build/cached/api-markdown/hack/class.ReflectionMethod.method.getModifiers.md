``` yamlmeta
{
    "name": "getModifiers",
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
public function getModifiers(): int;
```




net/manual/en/reflectionmethod.getmodifiers.php )




Returns a bitfield of the access modifiers for this method.




## Returns




+ ` int ` - A numeric representation of the modifiers. The
  modifiers are listed below. The actual meanings of
  these modifiers are described in the predefined
  constants.
<!-- HHAPIDOC -->
