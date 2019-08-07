``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\from_async",
    "sources": [
        "api-sources/hsl/src/dict/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Dict\\gen()` in Facebook's www repository."
    ]
}
```




Returns a new dict with each value ` await `ed in parallel




``` Hack
namespace HH\Lib\Dict;

function from_async<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, Awaitable<\Tv>> $awaitables,
): Awaitable<dict<\Tk, \Tv>>;
```




Time complexity: O(n * a), where a is the complexity of each Awaitable
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, Awaitable<\Tv>> $awaitables `




## Returns




* ` Awaitable<dict<\Tk, \Tv>> `
<!-- HHAPIDOC -->
