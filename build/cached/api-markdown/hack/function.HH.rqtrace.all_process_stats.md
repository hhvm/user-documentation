``` yamlmeta
{
    "name": "HH\\rqtrace\\all_process_stats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_rqtrace.hhi"
    ]
}
```




Return a map of event_name->EventStats for all events which occurred during
previously completed requests at the time this function was called




``` Hack
namespace HH\rqtrace;

function all_process_stats(): dict<string, dict<string, int>>;
```




## Returns




+ ` dict<string, dict<string, int>> `
<!-- HHAPIDOC -->
