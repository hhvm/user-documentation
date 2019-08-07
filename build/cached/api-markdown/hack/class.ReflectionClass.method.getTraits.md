``` yamlmeta
{
    "name": "getTraits",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getTraits(): darray<string, ReflectionClass>;
```




net/manual/en/reflectionclass.gettraits.php )




Warning: This function is currently not documented; only its argument
list is available.




## Returns




+ ` mixed ` - Returns an array with trait names in keys and
  instances of trait's ReflectionClass in values.
  Returns NULL in case of an error.
<!-- HHAPIDOC -->
