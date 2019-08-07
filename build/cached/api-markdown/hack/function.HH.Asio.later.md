``` yamlmeta
{
    "name": "HH\\Asio\\later",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/convenience.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Reschedule the work of an async function until some other time in the
future




``` Hack
namespace HH\Asio;

function later(): Awaitable<\void>;
```




The common use case for this is if your async function actually has to wait
for some blocking call, you can tell other ` Awaitable `s in the async
scheduler that they can work while this one waits for the blocking call to
finish (e.g., maybe in a polling situation or something).




## Returns




+ ` Awaitable<\void> ` - `` Awaitable `` of ``` void ```.
<!-- HHAPIDOC -->
