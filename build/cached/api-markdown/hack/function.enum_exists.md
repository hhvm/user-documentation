``` yamlmeta
{
    "name": "enum_exists",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_classobj.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_class.hhi"
    ]
}
```




Checks if the enum exists







``` Hack
function enum_exists(
  string $class_name,
  bool $autoload = true,
): bool;
```




## Parameters




+ ` string $class_name `
+ ` bool $autoload = true ` -




## Returns




* ` bool ` - - Returns TRUE if enum exists, FALSE if not
<!-- HHAPIDOC -->
