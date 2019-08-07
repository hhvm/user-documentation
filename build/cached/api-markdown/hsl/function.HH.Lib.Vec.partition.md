``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\partition",
    "sources": [
        "api-sources/hsl/src/vec/divide.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a 2-tuple containing vecs for which the given predicate returned
` true ` and `` false ``, respectively




``` Hack
namespace HH\Lib\Vec;

function partition<\Tv>(
  \  Traversable<\Tv> $traversable,
  \callable $predicate,
): \tuple<vec<\Tv>, vec<\Tv>>;
```




Time complexity: O(n * p), where p is the complexity of ` $predicate `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` \tuple<vec<\Tv>, vec<\Tv>> `
<!-- HHAPIDOC -->
