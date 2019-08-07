``` yamlmeta
{
    "name": "HH\\AsyncIterator",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/AsyncIterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\AsyncIterator"
}
```




Allows for the iteration over the values provided by an ` async ` function




If an ` async ` function returns an `` AsyncIterator<T> ``, then you can iterate
over the ``` T ``` values returned from that function.




```
async function countdown(int $start): AsyncIterator<int> { ... }

async function use_countdown(): Awaitable<void> {
  $async_iter = countdown(100);
  foreach ($async_iter await as $value) { ... }
}
```




## Interface Synopsis




``` Hack
namespace HH;

interface AsyncIterator {...}
```




### Public Methods




+ [` ->next(): Awaitable<?\tuple<\mixed, \Tv>> `](</hack/reference/interface/HH.AsyncIterator/next/>)\
  Move the async iterator to the next `` Awaitable `` position
<!-- HHAPIDOC -->
