``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\filter_nulls",
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




Returns a new vec containing only non-null values of the given
Traversable




``` Hack
namespace HH\Lib\Vec;

function filter_nulls<\Tv>(
  \  Traversable<?\Tv> $traversable,
): vec<\Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<?\Tv> $traversable `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
