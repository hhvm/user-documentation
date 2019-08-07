``` yamlmeta
{
    "name": "hphp_crash_log",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_output.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_output.hhi"
    ]
}
```




``` Hack
function hphp_crash_log(
  string $name,
  string $value,
): void;
```




## Parameters




+ ` string $name `
+ ` string $value `




## Returns




* ` void `
<!-- HHAPIDOC -->
