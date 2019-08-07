``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\filter_async",
    "sources": [
        "api-sources/hsl/src/keyset/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Keyset\\gen_filter()` in Facebook's www repository."
    ]
}
```




Returns a new keyset containing only the values for which the given async
predicate returns ` true `




``` Hack
namespace HH\Lib\Keyset;

function filter_async<\Tv as arraykey>(
  \  Container<\Tv> $traversable,
  \callable $value_predicate,
): Awaitable<keyset<\Tv>>;
```




For non-async predicates, see ` Keyset\filter() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
Space complexity: O(n)




## Parameters




+ ` \ Container<\Tv> $traversable `
+ ` \callable $value_predicate `




## Returns




* ` Awaitable<keyset<\Tv>> `
<!-- HHAPIDOC -->
