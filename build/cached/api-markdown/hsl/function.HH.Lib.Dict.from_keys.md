``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\from_keys",
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
function on the corresponding key




``` Hack
namespace HH\Lib\Dict;

function from_keys<\Tk as arraykey, \Tv>(
  \  Traversable<\Tk> $keys,
  \callable $value_func,
): dict<\Tk, \Tv>;
```




+ To use an async function, see ` Dict\from_keys_async() `.
+ To create a dict from values, see ` Dict\from_values() `.
+ To create a dict from key/value tuples, see ` Dict\from_entries() `.




Time complexity: O(n * f), where f is the complexity of ` $value_func `
Space complexity: O(n)




## Parameters




* ` \ Traversable<\Tk> $keys `
* ` \callable $value_func `




## Returns




- ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
