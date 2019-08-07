``` yamlmeta
{
    "name": "HH\\Asio\\result",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Get result of an already finished Awaitable




``` Hack
namespace HH\Asio;

function result<\T>(
  Awaitable<\T> $awaitable,
): \T;
```




Throws an InvalidOperationException if the Awaitable is not finished.




## Parameters




+ ` Awaitable<\T> $awaitable `




## Returns




* ` \T `
<!-- HHAPIDOC -->
