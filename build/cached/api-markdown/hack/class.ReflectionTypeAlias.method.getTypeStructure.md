``` yamlmeta
{
    "name": "getTypeStructure",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeAlias"
}
```




Get the TypeStructure that contains the full type information of
the assigned type




``` Hack
public function getTypeStructure(): darray;
```




## Returns




+ ` array ` - The type structure of the type alias.
<!-- HHAPIDOC -->
