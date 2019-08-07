``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\from_async",
    "sources": [
        "api-sources/hsl/src/vec/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Vec\\gen()` in Facebook's www repository."
    ]
}
```




Returns a new vec with each value ` await `ed in parallel




``` Hack
namespace HH\Lib\Vec;

function from_async<\Tv>(
  \  Traversable<Awaitable<\Tv>> $awaitables,
): Awaitable<vec<\Tv>>;
```




Time complexity: O(n * a), where a is the complexity of each Awaitable
Space complexity: O(n)




## Parameters




+ ` \ Traversable<Awaitable<\Tv>> $awaitables `




## Returns




* ` Awaitable<vec<\Tv>> `
<!-- HHAPIDOC -->
