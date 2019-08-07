``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\unique",
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




Returns a new vec containing each element of the given Traversable exactly
once




``` Hack
namespace HH\Lib\Vec;

function unique<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
): vec<\Tv>;
```




The Traversable must contain arraykey values, and strict equality will
be used.




For non-arraykey elements, see ` Vec\unique_by() `.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
