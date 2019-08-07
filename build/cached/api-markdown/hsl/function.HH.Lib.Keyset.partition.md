``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\partition",
    "sources": [
        "api-sources/hsl/src/keyset/divide.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a 2-tuple containing keysets for which the given predicate returned
` true ` and `` false ``, respectively




``` Hack
namespace HH\Lib\Keyset;

function partition<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
  \callable $predicate,
): \tuple<keyset<\Tv>, keyset<\Tv>>;
```




Time complexity: O(n * p), where p is the complexity of ` $predicate `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` \tuple<keyset<\Tv>, keyset<\Tv>> `
<!-- HHAPIDOC -->
