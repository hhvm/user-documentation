``` yamlmeta
{
    "name": "HH\\Lib\\C\\find_key",
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




Returns the key of the first value of the given KeyedTraversable for which
the predicate returns true, or null if no such value is found




``` Hack
namespace HH\Lib\C;

function find_key<\Tk, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $value_predicate,
): ?\Tk;
```




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` \callable $value_predicate `




## Returns




* ` ?\Tk `
<!-- HHAPIDOC -->
