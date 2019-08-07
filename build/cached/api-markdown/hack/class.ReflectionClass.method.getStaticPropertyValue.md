``` yamlmeta
{
    "name": "getStaticPropertyValue",
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
public function getStaticPropertyValue(
  string $name,
  mixed ...$def_value = NULL,
): mixed;
```




net/manual/en/reflectionclass.getstaticpropertyvalue.php )




Gets the value of a static property on this class.




## Parameters




+ ` string $name `
+ ` mixed ...$def_value = NULL `




## Returns




* ` mixed ` - The value of the static property.
<!-- HHAPIDOC -->
