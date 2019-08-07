``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\filter_nulls",
    "sources": [
        "api-sources/hsl/src/dict/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Given a KeyedTraversable with nullable values, returns a new dict with
those entries removed




``` Hack
namespace HH\Lib\Dict;

function filter_nulls<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, ?\Tv> $traversable,
): dict<\Tk, \Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, ?\Tv> $traversable `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
