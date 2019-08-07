``` yamlmeta
{
    "name": "HH\\Asio\\cancel",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Cancel Awaitable, if it's still pending




``` Hack
namespace HH\Asio;

function cancel<\T>(
  Awaitable<\T, \mixed> $awaitable,
  \Exception $exception,
): bool;
```




If Awaitable has not been completed yet, fails Awaitable with
$exception and returns true.
Otherwise, returns false.




Throws InvalidArgumentException, if Awaitable does not support cancellation.




## Parameters




+ ` Awaitable<\T, \mixed> $awaitable `
+ ` \Exception $exception `




## Returns




* ` bool `
<!-- HHAPIDOC -->
