``` yamlmeta
{
    "name": "HH\\rqtrace\\is_enabled",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_rqtrace.hhi"
    ]
}
```




Checks wither rqtrace is enabled for the current request




``` Hack
namespace HH\rqtrace;

function is_enabled(): bool;
```




## Returns




+ ` bool `
<!-- HHAPIDOC -->
