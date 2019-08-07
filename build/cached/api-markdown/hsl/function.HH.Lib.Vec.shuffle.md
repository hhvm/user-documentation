``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\shuffle",
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




Returns a new vec with the values of the given Traversable in a random
order




``` Hack
namespace HH\Lib\Vec;

function shuffle<\Tv>(
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
