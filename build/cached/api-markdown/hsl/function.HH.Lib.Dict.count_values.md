``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\count_values",
    "sources": [
        "api-sources/hsl/src/dict/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict mapping each value to the number of times it appears
in the given Traversable




``` Hack
namespace HH\Lib\Dict;

function count_values<\Tv as arraykey>(
  \  Traversable<\Tv> $values,
): dict<\Tv, int>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $values `




## Returns




* ` dict<\Tv, int> `
<!-- HHAPIDOC -->
