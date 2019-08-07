``` yamlmeta
{
    "name": "HH\\ext_watchman_version",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/watchman/ext_watchman.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_watchman.hhi"
    ]
}
```




This should be bumped with every non-backwards compatible API change




``` Hack
namespace HH;

function ext_watchman_version(): int;
```




1 => first version




## Returns




+ ` int `
<!-- HHAPIDOC -->
