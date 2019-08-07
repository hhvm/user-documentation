``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\map_async",
    "sources": [
        "api-sources/hsl/src/vec/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Vec\\gen_map()` in Facebook's www repository."
    ]
}
```




Returns a new vec where each value is the result of calling the given
async function on the original value




``` Hack
namespace HH\Lib\Vec;

function map_async<\Tv1, \Tv2>(
  \  Traversable<\Tv1> $traversable,
  \callable $async_func,
): Awaitable<vec<\Tv2>>;
```




For non-async functions, see ` Vec\map() `.




Time complexity: O(n * f), where ` f ` is the complexity of `` $async_func ``
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv1> $traversable `
+ ` \callable $async_func `




## Returns




* ` Awaitable<vec<\Tv2>> `
<!-- HHAPIDOC -->
