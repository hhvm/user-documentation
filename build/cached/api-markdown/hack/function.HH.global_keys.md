``` yamlmeta
{
    "name": "HH\\global_keys",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/std/ext_std_variable.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_globals.hhi"
    ]
}
```




``` Hack
namespace HH;

function global_keys(): keyset<string>;
```




## Returns




+ ` keyset<string> `
<!-- HHAPIDOC -->
