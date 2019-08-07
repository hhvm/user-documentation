``` yamlmeta
{
    "name": "HH\\asio_get_running",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Get currently running wait handle, or null if there is none




``` Hack
namespace HH;

function asio_get_running(): ResumableWaitHandle;
```




## Returns




+ ` ResumableWaitHandle `
<!-- HHAPIDOC -->
