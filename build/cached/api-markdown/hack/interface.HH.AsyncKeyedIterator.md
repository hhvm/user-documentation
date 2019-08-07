``` yamlmeta
{
    "name": "HH\\AsyncKeyedIterator",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/AsyncKeyedIterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\AsyncKeyedIterator"
}
```




Allows for the iteration over the keys and values provided by an ` async `
function




If an ` async ` function returns an `` AsyncIterator<Tk, Tv> ``, then you can
iterate over the ``` Tk ``` and ```` Tv ```` values returned from that function.




```
async function countdown(int $start): AsyncIterator<int, string> { ... }

async function use_countdown(): Awaitable<void> {
  $async_iter = countdown(100);
  foreach ($async_gen await as $num => $str) { ... }
}
```




## Interface Synopsis




``` Hack
namespace HH;

interface AsyncKeyedIterator implements AsyncIterator {...}
```




### Public Methods




+ [` ->next(): Awaitable<?\tuple<\Tk, \Tv>> `](</hack/reference/interface/HH.AsyncKeyedIterator/next/>)\
  Move the async iterator to the next `` Awaitable `` position
<!-- HHAPIDOC -->
