``` yamlmeta
{
    "name": "HH\\Asio\\va",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vm.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Translate a varargs of ` Awaitable `s into a single `` Awaitable<(...)> ``




``` Hack
namespace HH\Asio;

function va(
  ...$awaitables,
): Awaitable;
```




This function's behavior cannot be expressed with type hints,
so it's hardcoded in the typechecker:




```
HH\Asio\va(Awaitable<T1>, Awaitable<T2>, ... , Awaitable<Tn>)
```




will return




```
Awaitable<(T1, T2, ..., Tn)>
```




## Parameters




+ ` ...$awaitables `




## Returns




* ` Awaitable `
<!-- HHAPIDOC -->
