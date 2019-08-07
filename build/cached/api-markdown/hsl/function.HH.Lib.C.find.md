``` yamlmeta
{
    "name": "HH\\Lib\\C\\find",
    "sources": [
        "api-sources/hsl/src/c/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the first value of the given Traversable for which the predicate
returns true, or null if no such value is found




``` Hack
namespace HH\Lib\C;

function find<\T>(
  \  Traversable<\T> $traversable,
  \callable $value_predicate,
): ?\T;
```




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` \ Traversable<\T> $traversable `
+ ` \callable $value_predicate `




## Returns




* ` ?\T `
<!-- HHAPIDOC -->
