``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\sort",
    "sources": [
        "api-sources/hsl/src/keyset/order.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset sorted by the values of the given Traversable




``` Hack
namespace HH\Lib\Keyset;

function sort<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
  ?\callable $comparator = NULL,
): keyset<\Tv>;
```




If the
optional comparator function isn't provided, the values will be sorted in
ascending order.




Time complexity: O((n log n) * c), where c is the complexity of the
comparator function (which is O(1) if not explicitly provided)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` ?\callable $comparator = NULL `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
