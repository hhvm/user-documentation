``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\sort_by",
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




Returns a new vec sorted by some scalar property of each value of the given
Traversable, which is computed by the given function




``` Hack
namespace HH\Lib\Vec;

function sort_by<\Tv, \Ts>(
  \  Traversable<\Tv> $traversable,
  \callable $scalar_func,
  ?\callable $comparator = NULL,
): vec<\Tv>;
```




If the optional
comparator function isn't provided, the values will be sorted in ascending
order of scalar key.




To sort by the values of the Traversable, see ` Vec\sort() `.




Time complexity: O((n log n) * c + n * s), where c is the complexity of the
comparator function (which is O(1) if not provided explicitly) and s is the
complexity of the scalar function
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` \callable $scalar_func `
+ ` ?\callable $comparator = NULL `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
