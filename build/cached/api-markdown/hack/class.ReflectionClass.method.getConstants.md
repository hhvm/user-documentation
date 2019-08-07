``` yamlmeta
{
    "name": "getConstants",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getConstants(): darray<string, mixed>;
```




net/manual/en/reflectionclass.getconstants.php
)




Gets defined constants from a class. Warning: This function is
currently not documented; only its argument list is available.




## Returns




+ ` array ` - An array of constants. Constant name in key,
  constant value in value.
<!-- HHAPIDOC -->
