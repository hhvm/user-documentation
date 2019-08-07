``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\map",
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




Returns a new vec where each value is the result of calling the given
function on the original value




``` Hack
namespace HH\Lib\Vec;

function map<\Tv1, \Tv2>(
  \  Traversable<\Tv1> $traversable,
  \callable $value_func,
): vec<\Tv2>;
```




For async functions, see ` Vec\map_async() `.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv1> $traversable `
+ ` \callable $value_func `




## Returns




* ` vec<\Tv2> `
<!-- HHAPIDOC -->
