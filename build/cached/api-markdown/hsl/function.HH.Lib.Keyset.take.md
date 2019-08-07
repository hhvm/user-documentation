``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\take",
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




Returns a new keyset containing the first ` $n ` elements of the given
Traversable




``` Hack
namespace HH\Lib\Keyset;

function take<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
  int $n,
): keyset<\Tv>;
```




If there are duplicate values in the Traversable, the keyset may be shorter
than the specified length.




To drop the first ` $n ` elements, see `` Keyset\drop() ``.




Time complexity: O(n), where n is ` $n `
Space complexity: O(n), where n is `` $n ``




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $n `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
