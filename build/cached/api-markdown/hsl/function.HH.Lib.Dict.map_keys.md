``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\map_keys",
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




Returns a new dict where each key is the result of calling the given
function on the original key




``` Hack
namespace HH\Lib\Dict;

function map_keys<\Tk1, \Tk2 as arraykey, \Tv>(
  \  KeyedTraversable<\Tk1, \Tv> $traversable,
  \callable $key_func,
): dict<\Tk2, \Tv>;
```




In the case of duplicate keys, later values
will overwrite the previous ones.




Time complexity: O(n * f), where f is the complexity of ` $key_func `
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk1, \Tv> $traversable `
+ ` \callable $key_func `




## Returns




* ` dict<\Tk2, \Tv> `
<!-- HHAPIDOC -->
