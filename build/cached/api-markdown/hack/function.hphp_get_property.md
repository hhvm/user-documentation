``` yamlmeta
{
    "name": "hphp_get_property",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_get_property() - Used by ReflectionProperty to get the value of a
property on an instance of a class




``` Hack
function hphp_get_property(
  object $obj,
  string $cls = '',
  string $prop,
): mixed;
```




## Parameters




+ ` object $obj ` - The object to get the property from.
+ ` string $cls = '' ` - The name of the class that the property is accessible
  in or null to only get a public property.
+ ` string $prop ` - The name of the property.




## Returns




* ` mixed ` - - The value of the property.
<!-- HHAPIDOC -->
