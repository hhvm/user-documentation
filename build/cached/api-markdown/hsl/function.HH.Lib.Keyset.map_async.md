``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\map_async",
    "sources": [
        "api-sources/hsl/src/keyset/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Keyset\\gen_map()` in Facebook's www repository."
    ]
}
```




Returns a new keyset where the value is the result of calling the
given async function on the original values in the given traversable




``` Hack
namespace HH\Lib\Keyset;

function map_async<\Tv, \Tk as arraykey>(
  \  Traversable<\Tv> $traversable,
  \callable $async_func,
): Awaitable<keyset<\Tk>>;
```




Time complexity: O(n * f), where f is the complexity of ` $async_func `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` \callable $async_func `




## Returns




* ` Awaitable<keyset<\Tk>> `
<!-- HHAPIDOC -->
