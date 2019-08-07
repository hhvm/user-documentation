``` yamlmeta
{
    "name": "hphp_create_object",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




hphp_create_object() - Used by ReflectionClass to create a new instance of an
object, including calling the constructor




``` Hack
function hphp_create_object<T>(
  string $class_name,
  array $params,
): T;
```




## Parameters




+ ` string $class_name `
+ ` array $params ` - The parameters to pass to the constructor.




## Returns




* ` object ` - - The newly created object
<!-- HHAPIDOC -->
