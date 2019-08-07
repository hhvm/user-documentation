``` yamlmeta
{
    "name": "HH\\rqtrace\\process_event_stats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_rqtrace.hhi"
    ]
}
```




Return stats for all occurences of $event during previously completed
requests when this function was called




``` Hack
namespace HH\rqtrace;

function process_event_stats(
  string $event_name,
): dict<string, int>;
```




## Parameters




+ ` string $event_name `




## Returns




* ` dict<string, int> `
<!-- HHAPIDOC -->
