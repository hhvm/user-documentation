``` yamlmeta
{
    "name": "HH\\global_key_exists",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_variable.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_globals.hhi"
    ]
}
```




``` Hack
namespace HH;

function global_key_exists(
  string $key,
): bool;
```




## Parameters




+ ` string $key `




## Returns




* ` bool `
<!-- HHAPIDOC -->
