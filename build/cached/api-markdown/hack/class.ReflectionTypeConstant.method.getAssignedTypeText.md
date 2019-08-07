``` yamlmeta
{
    "name": "getAssignedTypeText",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeConstant"
}
```




Get the type assigned to this type constant as a string







``` Hack
public function getAssignedTypeText(): ?string;
```




## Returns




+ ` NULL ` - | string   The assigned type or null if is abstract
<!-- HHAPIDOC -->
