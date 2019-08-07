``` yamlmeta
{
    "name": "hphp_get_static_property",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_get_static_property() - Used by ReflectionProperty to get the value of a
static property on a class




``` Hack
function hphp_get_static_property(
  string $cls,
  string $prop,
  bool $force,
): mixed;
```




## Parameters




+ ` string $cls ` - The name of the class.
+ ` string $prop ` - The name of the static property
+ ` bool $force ` - Whether or not to get protected and private properties
  (true) or only public ones (false)




## Returns




* ` mixed ` - - The value of the property
<!-- HHAPIDOC -->
