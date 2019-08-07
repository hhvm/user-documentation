``` yamlmeta
{
    "name": "getTraitAliases",
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
public function getTraitAliases(): darray<string>;
```




net/manual/en/reflectionclass.gettraitaliases.php )




Warning: This function is currently not documented; only its argument
list is available.




## Returns




+ ` mixed ` - Returns an array with new method names in keys and
  original names (in the format "TraitName::original")
  in values. Returns NULL in case of an error.
<!-- HHAPIDOC -->
