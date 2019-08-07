``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\unique",
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




Returns a new dict in which each value appears exactly once




``` Hack
namespace HH\Lib\Dict;

function unique<\Tk as arraykey, \Tv as arraykey>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): dict<\Tk, \Tv>;
```




In case of
duplicate values, later keys will overwrite the previous ones.




For non-arraykey values, see ` Dict\unique_by() `.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
