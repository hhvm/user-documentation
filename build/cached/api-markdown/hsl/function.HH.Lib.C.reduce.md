``` yamlmeta
{
    "name": "HH\\Lib\\C\\reduce",
    "sources": [
        "api-sources/hsl/src/c/reduce.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Reduces the given Traversable into a single value by applying an accumulator
function against an intermediate result and each value




``` Hack
namespace HH\Lib\C;

function reduce<\Tv, \Ta>(
  \  Traversable<\Tv> $traversable,
  \callable $accumulator,
  \Ta $initial,
): \Ta;
```




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` \callable $accumulator `
+ ` \Ta $initial `




## Returns




* ` \Ta `
<!-- HHAPIDOC -->
