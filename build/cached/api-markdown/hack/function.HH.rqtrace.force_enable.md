``` yamlmeta
{
    "name": "HH\\rqtrace\\force_enable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_rqtrace.hhi"
    ]
}
```




Forcibly enable rqtrace for the current request if it is not already enabled




``` Hack
namespace HH\rqtrace;

function force_enable(): \void;
```




## Returns




+ ` \void `
<!-- HHAPIDOC -->
