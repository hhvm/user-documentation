``` yamlmeta
{
    "name": "HH\\watchman_check_sub",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/watchman/ext_watchman.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_watchman.hhi"
    ]
}
```




``` Hack
namespace HH;

function watchman_check_sub(
  string $sub_name,
): bool;
```




## Parameters




+ ` string $sub_name `




## Returns




* ` bool `
<!-- HHAPIDOC -->
