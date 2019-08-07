``` yamlmeta
{
    "name": "getConstant",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt from http://php




``` Hack
public function getConstant(
  string $name,
): mixed;
```




net/manual/en/reflectionclass.getconstant.php
)




Gets the defined constant. Warning: This function is currently not
documented; only its argument list is available.




## Parameters




+ ` string $name `




## Returns




* ` mixed ` - Value of the constant, or FALSE if it doesn't exist
<!-- HHAPIDOC -->
