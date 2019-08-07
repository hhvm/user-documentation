``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\map",
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




Returns a new dict where each value is the result of calling the given
function on the original value




``` Hack
namespace HH\Lib\Dict;

function map<\Tk as arraykey, \Tv1, \Tv2>(
  \  KeyedTraversable<\Tk, \Tv1> $traversable,
  \callable $value_func,
): dict<\Tk, \Tv2>;
```




To use an async function, see ` Dict\map_async() `.




Time complexity: O(n * f), where f is the complexity of ` $value_func `
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv1> $traversable `
+ ` \callable $value_func `




## Returns




* ` dict<\Tk, \Tv2> `
<!-- HHAPIDOC -->
