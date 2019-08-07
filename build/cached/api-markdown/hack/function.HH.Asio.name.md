``` yamlmeta
{
    "name": "HH\\Asio\\name",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Get the name of the Awaitable




``` Hack
namespace HH\Asio;

function name<\T>(
  Awaitable<\T, \mixed> $awaitable,
): string;
```




## Parameters




+ ` Awaitable<\T, \mixed> $awaitable `




## Returns




* ` string `
<!-- HHAPIDOC -->
