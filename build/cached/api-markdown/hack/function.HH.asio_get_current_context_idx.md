``` yamlmeta
{
    "name": "HH\\asio_get_current_context_idx",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Get index of the current scheduler context, or 0 if there is none




``` Hack
namespace HH;

function asio_get_current_context_idx(): int;
```




## Returns




+ ` int `
<!-- HHAPIDOC -->
