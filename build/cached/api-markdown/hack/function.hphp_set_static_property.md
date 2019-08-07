``` yamlmeta
{
    "name": "hphp_set_static_property",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_set_static_property() - Used by ReflectionProperty to set the value of a
static property on a class




``` Hack
function hphp_set_static_property(
  string $cls,
  string $prop,
  mixed $value,
  bool $force,
): void;
```




## Parameters




+ ` string $cls ` - The name of the class.
+ ` string $prop ` - The name of the static property
+ ` mixed $value ` - The value to set the property to
+ ` bool $force ` - Whether or not to set protected and private properties
  (true) or only public ones (false)




## Returns




* ` void `
<!-- HHAPIDOC -->
