``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\filter_with_key_async",
    "sources": [
        "api-sources/hsl/src/dict/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Dict\\gen_filter_with_key()` in Facebook's www repository."
    ]
}
```




Like filter_async, but lets you utilize the keys of your dict too




``` Hack
namespace HH\Lib\Dict;

function filter_with_key_async<\Tk as arraykey, \Tv>(
  \  KeyedContainer<\Tk, \Tv> $traversable,
  \callable $predicate,
): Awaitable<dict<\Tk, \Tv>>;
```




For non-async filters with key, see ` Dict\filter_with_key() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
Space complexity: O(n)




## Parameters




+ ` \ KeyedContainer<\Tk, \Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` Awaitable<dict<\Tk, \Tv>> `
<!-- HHAPIDOC -->
