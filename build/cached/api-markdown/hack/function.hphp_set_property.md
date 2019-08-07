``` yamlmeta
{
    "name": "hphp_set_property",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_set_property() - Used by ReflectionProperty to set the value of a
property on an instance of a class




``` Hack
function hphp_set_property(
  object $obj,
  string $cls = '',
  string $prop,
  mixed $value,
): void;
```




## Parameters




+ ` object $obj ` - The object to set the property on.
+ ` string $cls = '' ` - The name of the class that the property is accessible
  in or null to only set a public property.
+ ` string $prop ` - The name of the property.
+ ` mixed $value ` - The value to set the property to.




## Returns




* ` void `
<!-- HHAPIDOC -->
