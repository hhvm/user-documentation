``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\reverse",
    "sources": [
        "api-sources/hsl/src/vec/order.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec with the values of the given Traversable in reversed
order




``` Hack
namespace HH\Lib\Vec;

function reverse<\Tv>(
  \  Traversable<\Tv> $traversable,
): vec<\Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
