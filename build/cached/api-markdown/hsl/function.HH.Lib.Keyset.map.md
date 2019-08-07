``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\map",
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




Returns a new keyset where each value is the result of calling the given
function on the original value




``` Hack
namespace HH\Lib\Keyset;

function map<\Tv1, \Tv2 as arraykey>(
  \  Traversable<\Tv1> $traversable,
  \callable $value_func,
): keyset<\Tv2>;
```




Time complexity: O(n * f), where f is the complexity of ` $value_func `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv1> $traversable `
+ ` \callable $value_func `




## Returns




* ` keyset<\Tv2> `
<!-- HHAPIDOC -->
