``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\from_keys_async",
    "sources": [
        "api-sources/hsl/src/dict/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Dict\\gen_from_keys()` in Facebook's www repository."
    ]
}
```




Returns a new dict where each value is the result of calling the given
async function on the corresponding key




``` Hack
namespace HH\Lib\Dict;

function from_keys_async<\Tk as arraykey, \Tv>(
  \  Traversable<\Tk> $keys,
  \callable $async_func,
): Awaitable<dict<\Tk, \Tv>>;
```




For non-async functions, see ` Dict\from_keys() `.




Time complexity: O(n * f), where f is the complexity of ` $async_func `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tk> $keys `
+ ` \callable $async_func `




## Returns




* ` Awaitable<dict<\Tk, \Tv>> `
<!-- HHAPIDOC -->
