``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\from_entries",
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




Returns a new dict where each mapping is defined by the given key/value
tuples




``` Hack
namespace HH\Lib\Dict;

function from_entries<\Tk as arraykey, \Tv>(
  \  Traversable<\tuple<\Tk, \Tv>> $entries,
): dict<\Tk, \Tv>;
```




In the case of duplicate keys, later values will overwrite the
previous ones.




+ To create a dict from keys, see ` Dict\from_keys() `.
+ To create a dict from values, see ` Dict\from_values() `.




Also known as ` unzip ` or `` fromItems `` in other implementations.




Time complexity: O(n)
Space complexity: O(n)




## Parameters




* ` \ Traversable<\tuple<\Tk, \Tv>> $entries `




## Returns




- ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
