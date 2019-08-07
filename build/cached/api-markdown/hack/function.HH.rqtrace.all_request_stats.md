``` yamlmeta
{
    "name": "HH\\rqtrace\\all_request_stats",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh/ext_hh.php",
        "api-sources/hhvm/hphp/hack/hhi/ext_rqtrace.hhi"
    ]
}
```




``` Hack
namespace HH\rqtrace;

function all_request_stats(): dict<string, dict<string, int>>;
```




## Returns




+ ` Dict ( [EVENT_NAME ` - => Dict
  (
  [duration] => int (microseconds)
  [count] => int
  )
  ...
  )
<!-- HHAPIDOC -->
