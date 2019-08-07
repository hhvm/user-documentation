``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\reverse",
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




Returns a new dict with the original entries in reversed iteration
order




``` Hack
namespace HH\Lib\Dict;

function reverse<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): dict<\Tk, \Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
