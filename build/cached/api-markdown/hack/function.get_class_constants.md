``` yamlmeta
{
    "name": "get_class_constants",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_classobj.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Get the constants of the given class




``` Hack
function get_class_constants(
  string $class_name,
): array<string, mixed>;
```




## Parameters




+ ` string $class_name ` - The class name




## Returns




* ` array ` - - Returns an associative array of constants with their values.
<!-- HHAPIDOC -->
