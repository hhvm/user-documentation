``` yamlmeta
{
    "name": "HH\\Asio\\usleep",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/convenience.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Wait for a certain length of time before an async function does any more
work




``` Hack
namespace HH\Asio;

function usleep(
  int $usecs,
): Awaitable<\void>;
```




This is similar to calling the PHP builtin
[` usleep `](<http://php.net/manual/en/function.usleep.php>) funciton, but is
in the context of async, meaning that other `` Awaitable ``s in the async
scheduler can run while the async function that called ``` usleep() ``` waits until
the length of time before asking to resume again.




## Parameters




+ ` int $usecs ` - The amount of time to wait, in microseconds.




## Returns




* ` Awaitable<\void> ` - `` Awaitable `` of ``` void ```.
<!-- HHAPIDOC -->
