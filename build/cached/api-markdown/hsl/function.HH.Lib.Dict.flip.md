``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\flip",
    "sources": [
        "api-sources/hsl/src/dict/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict keyed by the values of the given KeyedTraversable
and vice-versa




``` Hack
namespace HH\Lib\Dict;

function flip<\Tk, \Tv as arraykey>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): dict<\Tv, \Tk>;
```




In case of duplicate values, later keys overwrite the
previous ones.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` dict<\Tv, \Tk> `
<!-- HHAPIDOC -->
