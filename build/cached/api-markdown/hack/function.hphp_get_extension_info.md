``` yamlmeta
{
    "name": "hphp_get_extension_info",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-internals-functions.php"
    ]
}
```




hphp_get_extension_info() - Internally used for getting extension's
information




``` Hack
function hphp_get_extension_info(
  string $name,
): array<string, mixed>;
```




## Parameters




+ ` string $name ` - Name of the extension




## Returns




* ` array ` - - A map containing the extension's name, version, info string
  ini settings, constants, functions and classes.
<!-- HHAPIDOC -->
