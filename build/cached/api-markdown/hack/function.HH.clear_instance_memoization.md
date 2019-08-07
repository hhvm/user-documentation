``` yamlmeta
{
    "name": "HH\\clear_instance_memoization",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/functions.hhi"
    ]
}
```




Clear memoization data on object instance




``` Hack
namespace HH;

function clear_instance_memoization(
  object $obj,
): bool;
```




## Parameters




+ ` object $obj `




## Returns




* ` bool `
<!-- HHAPIDOC -->
