``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\drop",
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




Returns a new dict containing all except the first ` $n ` entries of the
given KeyedTraversable




``` Hack
namespace HH\Lib\Dict;

function drop<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  int $n,
): dict<\Tk, \Tv>;
```




To take only the first ` $n ` entries, see `` Dict\take() ``.




Time complexity: O(n), where n is the size of ` $traversable `
Space complexity: O(n), where n is the size of `` $traversable ``




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` int $n `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
