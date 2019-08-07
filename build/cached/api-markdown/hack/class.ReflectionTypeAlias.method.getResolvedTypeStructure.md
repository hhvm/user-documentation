``` yamlmeta
{
    "name": "getResolvedTypeStructure",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionTypeAlias"
}
```




Get the TypeStructure with type information resolved




``` Hack
public function getResolvedTypeStructure(): darray;
```




Call at
your own peril as non-hoisted classes might cause fatal.




## Returns




+ ` array ` - The resolved type structure of the type alias.
<!-- HHAPIDOC -->
