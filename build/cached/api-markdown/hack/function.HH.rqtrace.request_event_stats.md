``` yamlmeta
{
    "name": "HH\\rqtrace\\request_event_stats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_rqtrace.hhi"
    ]
}
```




Return stats for occurences of $event during the current requests up to the
call of this function




``` Hack
namespace HH\rqtrace;

function request_event_stats(
  string $event_name,
): dict<string, int>;
```




## Parameters




+ ` string $event_name `




## Returns




* ` dict<string, int> `
<!-- HHAPIDOC -->
