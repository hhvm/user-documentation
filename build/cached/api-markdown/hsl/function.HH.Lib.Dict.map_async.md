``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\map_async",
    "sources": [
        "api-sources/hsl/src/dict/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Dict\\gen_map()` in Facebook's www repository."
    ]
}
```




Returns a new dict where each value is the result of calling the given
async function on the original value




``` Hack
namespace HH\Lib\Dict;

function map_async<\Tk as arraykey, \Tv1, \Tv2>(
  \  KeyedTraversable<\Tk, \Tv1> $traversable,
  \callable $value_func,
): Awaitable<dict<\Tk, \Tv2>>;
```




For non-async functions, see ` Dict\map() `.




Time complexity: O(n * f), where f is the complexity of ` $async_func `
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv1> $traversable `
+ ` \callable $value_func `




## Returns




* ` Awaitable<dict<\Tk, \Tv2>> `
<!-- HHAPIDOC -->
