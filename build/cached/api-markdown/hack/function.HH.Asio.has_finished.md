``` yamlmeta
{
    "name": "HH\\Asio\\has_finished",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Check whether the given Awaitable has finished




``` Hack
namespace HH\Asio;

function has_finished<\T>(
  Awaitable<\T, \mixed> $awaitable,
): bool;
```




## Parameters




+ ` Awaitable<\T, \mixed> $awaitable `




## Returns




* ` bool `
<!-- HHAPIDOC -->
