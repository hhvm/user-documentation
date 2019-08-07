``` yamlmeta
{
    "name": "getTraitNames",
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
public function getTraitNames(): varray<string>;
```




net/manual/en/reflectionclass.gettraitnames.php )




Warning: This function is currently not documented; only its argument
list is available.




## Returns




+ ` mixed ` - Returns an array with trait names in values. Returns
  NULL in case of an error.
<!-- HHAPIDOC -->
