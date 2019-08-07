``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\take",
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




Returns a new vec containing the first ` $n ` elements of the given
Traversable




``` Hack
namespace HH\Lib\Vec;

function take<\Tv>(
  \  Traversable<\Tv> $traversable,
  int $n,
): vec<\Tv>;
```




To drop the first ` $n ` elements, see `` Vec\drop() ``.




Time complexity: O(n), where n is ` $n `
Space complexity: O(n), where n is `` $n ``




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $n `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
