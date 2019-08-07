``` yamlmeta
{
    "name": "HH\\asio_get_running_in_context",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Get currently running wait handle in a context specified by its index




``` Hack
namespace HH;

function asio_get_running_in_context(
  int $ctx_idx,
): ResumableWaitHandle;
```




## Parameters




+ ` int $ctx_idx `




## Returns




* ` ResumableWaitHandle `
<!-- HHAPIDOC -->
