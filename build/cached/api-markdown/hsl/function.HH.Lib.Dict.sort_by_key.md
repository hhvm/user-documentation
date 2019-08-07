``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\sort_by_key",
    "sources": [
        "api-sources/hsl/src/dict/order.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict sorted by the keys of the given KeyedTraversable




``` Hack
namespace HH\Lib\Dict;

function sort_by_key<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  ?\callable $key_comparator = NULL,
): dict<\Tk, \Tv>;
```




If the
optional comparator function isn't provided, the keys will be sorted in
ascending order.




+ To sort by the values of the KeyedTraversable, see ` Dict\sort() `.
+ To sort by some computable property of each value, see ` Dict\sort_by() `.




Time complexity: O((n log n) * c), where c is the complexity of the
comparator function (which is O(1) if not provided explicitly)
Space complexity: O(n)




## Parameters




* ` \ KeyedTraversable<\Tk, \Tv> $traversable `
* ` ?\callable $key_comparator = NULL `




## Returns




- ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
