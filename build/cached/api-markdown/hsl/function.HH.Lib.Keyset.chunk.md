``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\chunk",
    "sources": [
        "api-sources/hsl/src/keyset/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a vec containing the given Traversable split into chunks of the
given size




``` Hack
namespace HH\Lib\Keyset;

function chunk<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
  int $size,
): vec<keyset<\Tv>>;
```




If the given Traversable doesn't divide evenly, the final chunk will be
smaller than the specified size. If there are duplicate values in the
Traversable, some chunks may be smaller than the specified size.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $size `




## Returns




* ` vec<keyset<\Tv>> `
<!-- HHAPIDOC -->
