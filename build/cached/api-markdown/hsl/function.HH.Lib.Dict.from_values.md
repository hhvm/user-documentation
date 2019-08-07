``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\from_values",
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




Returns a new dict keyed by the result of calling the given function on each
corresponding value




``` Hack
namespace HH\Lib\Dict;

function from_values<\Tk as arraykey, \Tv>(
  \  Traversable<\Tv> $values,
  \callable $key_func,
): dict<\Tk, \Tv>;
```




In the case of duplicate keys, later values will
overwrite the previous ones.




+ To create a dict from keys, see ` Dict\from_keys() `.
+ To create a dict from key/value tuples, see ` Dict\from_entries() `.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




* ` \ Traversable<\Tv> $values `
* ` \callable $key_func `




## Returns




- ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
