``` yamlmeta
{
    "name": "HH\\Lib\\C\\reduce_with_key",
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




Reduces the given KeyedTraversable into a single value by
applying an accumulator function against an intermediate result
and each key/value




``` Hack
namespace HH\Lib\C;

function reduce_with_key<\Tk, \Tv, \Ta>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $accumulator,
  \Ta $initial,
): \Ta;
```




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` \callable $accumulator `
+ ` \Ta $initial `




## Returns




* ` \Ta `
<!-- HHAPIDOC -->
