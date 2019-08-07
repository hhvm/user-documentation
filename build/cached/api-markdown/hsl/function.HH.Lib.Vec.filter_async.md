``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\filter_async",
    "sources": [
        "api-sources/hsl/src/vec/async.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    },
    "fbonly messages": [
        "This function is available as `Vec\\gen_filter()` in Facebook's www repository."
    ]
}
```




Returns a new vec containing only the values for which the given async
predicate returns ` true `




``` Hack
namespace HH\Lib\Vec;

function filter_async<\Tv>(
  \  Container<\Tv> $container,
  \callable $value_predicate,
): Awaitable<vec<\Tv>>;
```




For non-async predicates, see ` Vec\filter() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
Space complexity: O(n)




## Parameters




+ ` \ Container<\Tv> $container `
+ ` \callable $value_predicate `




## Returns




* ` Awaitable<vec<\Tv>> `
<!-- HHAPIDOC -->
