``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\partition",
    "sources": [
        "api-sources/hsl/src/dict/divide.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a 2-tuple containing dicts for which the given predicate returned
` true ` and `` false ``, respectively




``` Hack
namespace HH\Lib\Dict;

function partition<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $predicate,
): \tuple<dict<\Tk, \Tv>, dict<\Tk, \Tv>>;
```




Time complexity: O(n * p), where p is the complexity of ` $predicate `.
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` \tuple<dict<\Tk, \Tv>, dict<\Tk, \Tv>> `
<!-- HHAPIDOC -->
