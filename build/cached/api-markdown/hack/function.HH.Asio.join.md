``` yamlmeta
{
    "name": "HH\\Asio\\join",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Wait for a given Awaitable to finish and return its result




``` Hack
namespace HH\Asio;

function join<\T>(
  Awaitable<\T> $awaitable,
): \T;
```




Launches a new instance of scheduler to drive asynchronous execution
until the provided Awaitable is finished.




## Parameters




+ ` Awaitable<\T> $awaitable `




## Returns




* ` \T `
<!-- HHAPIDOC -->
