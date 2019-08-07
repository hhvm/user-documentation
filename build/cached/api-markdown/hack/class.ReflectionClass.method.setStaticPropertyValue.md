``` yamlmeta
{
    "name": "setStaticPropertyValue",
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
public function setStaticPropertyValue(
  string $name,
  mixed $value,
): void;
```




net/manual/en/reflectionclass.setstaticpropertyvalue.php )




Sets static property value. Warning: This function is currently not
documented; only its argument list is available.




## Parameters




+ ` string $name `
+ ` mixed $value `




## Returns




* ` void `
<!-- HHAPIDOC -->
