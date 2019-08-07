``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\chunk",
    "sources": [
        "api-sources/hsl/src/vec/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a vec containing the original vec split into chunks of the given
size




``` Hack
namespace HH\Lib\Vec;

function chunk<\Tv>(
  \  Traversable<\Tv> $traversable,
  int $size,
): vec<vec<\Tv>>;
```




If the original vec doesn't divide evenly, the final chunk will be
smaller.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` int $size `




## Returns




* ` vec<vec<\Tv>> `
<!-- HHAPIDOC -->
