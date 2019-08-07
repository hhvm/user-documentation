``` yamlmeta
{
    "name": "hphp_create_object_without_constructor",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_create_object_without_constructor() - Used by ReflectionClass to create
a new instance of an object,
without calling the constructor




``` Hack
function hphp_create_object_without_constructor(
  string $name,
): object;
```




## Parameters




+ ` string $name ` - The name of the object to create.




## Returns




* ` object ` - - The newly created object
<!-- HHAPIDOC -->
