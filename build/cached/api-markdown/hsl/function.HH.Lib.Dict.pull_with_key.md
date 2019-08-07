``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\pull_with_key",
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




Returns a new dict where:

+ values are the result of calling ` $value_func ` on the original value/key
+ keys are the result of calling ` $key_func ` on the original value/key




``` Hack
namespace HH\Lib\Dict;

function pull_with_key<\Tk1, \Tk2 as arraykey, \Tv1, \Tv2>(
  \  KeyedTraversable<\Tk1, \Tv1> $traversable,
  \callable $value_func,
  \callable $key_func,
): dict<\Tk2, \Tv2>;
```




In the case of duplicate keys, later values will overwrite the previous ones.




Time complexity: O(n * (f1 + f2), where f1 is the complexity of ` $value_func `
and f2 is the complexity of `` $key_func ``
Space complexity: O(n)




## Parameters




* ` \ KeyedTraversable<\Tk1, \Tv1> $traversable `
* ` \callable $value_func `
* ` \callable $key_func `




## Returns




- ` dict<\Tk2, \Tv2> `
<!-- HHAPIDOC -->
