``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\drop",
    "sources": [
        "api-sources/hsl/src/keyset/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset containing all except the first ` $n ` elements of
the given Traversable




``` Hack
namespace HH\Lib\Keyset;

function drop<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
  int $n,
): keyset<\Tv>;
```




To take only the first ` $n ` elements, see `` Keyset\take() ``.




Time complexity: O(n), where n is the size of ` $traversable `
Space complexity: O(n), where n is the size of `` $traversable ``




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $n `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
