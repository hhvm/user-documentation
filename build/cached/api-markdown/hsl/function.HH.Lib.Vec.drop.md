``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\drop",
    "sources": [
        "api-sources/hsl/src/vec/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec containing all except the first ` $n ` elements of the
given Traversable




``` Hack
namespace HH\Lib\Vec;

function drop<\Tv>(
  \  Traversable<\Tv> $traversable,
  int $n,
): vec<\Tv>;
```




To take only the first ` $n ` elements, see `` Vec\take() ``.




Time complexity: O(n), where n is the size of ` $traversable `
Space complexity: O(n), where n is the size of `` $traversable ``




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $n `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
