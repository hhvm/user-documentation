``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\filter_async",
    "sources": [
        "api-sources/hsl/src/dict/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Dict\\gen_filter()` in Facebook's www repository."
    ]
}
```




Returns a new dict containing only the values for which the given async
predicate returns ` true `




``` Hack
namespace HH\Lib\Dict;

function filter_async<\Tk as arraykey, \Tv>(
  \  KeyedContainer<\Tk, \Tv> $traversable,
  \callable $value_predicate,
): Awaitable<dict<\Tk, \Tv>>;
```




For non-async predicates, see ` Dict\filter() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
Space complexity: O(n)




## Parameters




+ ` \ KeyedContainer<\Tk, \Tv> $traversable `
+ ` \callable $value_predicate `




## Returns




* ` Awaitable<dict<\Tk, \Tv>> `
<!-- HHAPIDOC -->
