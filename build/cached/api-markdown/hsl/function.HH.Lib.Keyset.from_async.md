``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\from_async",
    "sources": [
        "api-sources/hsl/src/keyset/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Keyset\\gen()` in Facebook's www repository."
    ]
}
```




Returns a new keyset containing the awaited result of the given Awaitables




``` Hack
namespace HH\Lib\Keyset;

function from_async<\Tv as arraykey>(
  \  Traversable<Awaitable<\Tv>> $awaitables,
): Awaitable<keyset<\Tv>>;
```




Time complexity: O(n * a), where a is the complexity of each Awaitable
Space complexity: O(n)




## Parameters




+ ` \ Traversable<Awaitable<\Tv>> $awaitables `




## Returns




* ` Awaitable<keyset<\Tv>> `
<!-- HHAPIDOC -->
