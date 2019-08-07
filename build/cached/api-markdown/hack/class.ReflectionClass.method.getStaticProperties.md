``` yamlmeta
{
    "name": "getStaticProperties",
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
public function getStaticProperties(): darray<string, mixed>;
```




net/manual/en/reflectionclass.getstaticproperties.php )




Get the static properties. Warning: This function is currently not
documented; only its argument list is available.




## Returns




+ ` mixed ` - The static properties, as an array.
<!-- HHAPIDOC -->
