``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\sort_by",
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




Returns a new dict sorted by some scalar property of each value of the given
KeyedTraversable, which is computed by the given function




``` Hack
namespace HH\Lib\Dict;

function sort_by<\Tk as arraykey, \Tv, \Ts>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $scalar_func,
  ?\callable $scalar_comparator = NULL,
): dict<\Tk, \Tv>;
```




If the optional
comparator function isn't provided, the values will be sorted in ascending
order of scalar key.




+ To sort by the values of the KeyedTraversable, see ` Dict\sort() `.
+ To sort by the keys of the KeyedTraversable, see ` Dict\sort_by_key() `.




Time complexity: O((n log n) * c + n * s), where c is the complexity of the
comparator function (which is O(1) if not provided explicitly) and s is the
complexity of the scalar function
Space complexity: O(n)




## Parameters




* ` \ KeyedTraversable<\Tk, \Tv> $traversable `
* ` \callable $scalar_func `
* ` ?\callable $scalar_comparator = NULL `




## Returns




- ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
