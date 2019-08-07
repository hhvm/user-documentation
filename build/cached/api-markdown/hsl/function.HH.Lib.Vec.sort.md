``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\sort",
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




Returns a new vec sorted by the values of the given Traversable




``` Hack
namespace HH\Lib\Vec;

function sort<\Tv>(
  \  Traversable<\Tv> $traversable,
  ?\callable $comparator = NULL,
): vec<\Tv>;
```




If the
optional comparator function isn't provided, the values will be sorted in
ascending order.




To sort by some computable property of each value, see ` Vec\sort_by() `.




Time complexity: O((n log n) * c), where c is the complexity of the
comparator function (which is O(1) if not provided explicitly)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` ?\callable $comparator = NULL `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
