``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\take",
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




Returns a new dict containing the first ` $n ` entries of the given
KeyedTraversable




``` Hack
namespace HH\Lib\Dict;

function take<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  int $n,
): dict<\Tk, \Tv>;
```




To drop the first ` $n ` entries, see `` Dict\drop() ``.




Time complexity: O(n), where n is ` $n `
Space complexity: O(n), where n is `` $n ``




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` int $n `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
