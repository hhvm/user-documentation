``` yamlmeta
{
    "name": "HH\\Asio\\wrap",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/convenience.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Wrap an ` Awaitable ` into an `` Awaitable `` of ``` ResultOrExceptionWrapper ```




``` Hack
namespace HH\Asio;

function wrap<\Tv>(
  \  Awaitable<\Tv> $awaitable,
): Awaitable<\ResultOrExceptionWrapper<\Tv>>;
```




The actual ` ResultOrExceptionWrapper ` in the returned `` Awaitable `` will only
be available after you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ Awaitable<\Tv> $awaitable ` - The `` Awaitable `` to wrap.




## Returns




* ` Awaitable<\ResultOrExceptionWrapper<\Tv>> ` - the `` Awaitable `` of ``` ResultOrExceptionWrapper ```.
<!-- HHAPIDOC -->
