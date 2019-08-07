``` yamlmeta
{
    "name": "getProperties",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionClass"
}
```




( excerpt* http://php




``` Hack
public function getProperties(
  int $filter = 65535,
): varray<ReflectionProperty>;
```




net/manual/en/reflectionclass.getproperties.php )




Retrieves reflected properties.




## Parameters




+ ` int $filter = 65535 `




## Returns




* ` mixed ` - An array of ReflectionProperty objects.
<!-- HHAPIDOC -->
