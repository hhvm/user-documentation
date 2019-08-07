``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\select_keys",
    "sources": [
        "api-sources/hsl/src/dict/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict containing only the keys found in both the input container
and the given Traversable




``` Hack
namespace HH\Lib\Dict;

function select_keys<\Tk as arraykey, \Tv>(
  \  KeyedContainer<\Tk, \Tv> $container,
  \  Traversable<\Tk> $keys,
): dict<\Tk, \Tv>;
```




The dict will have the same ordering as the
` $keys ` Traversable.




Time complexity: O(k), where k is the size of ` $keys `.
Space complexity: O(k), where k is the size of `` $keys ``.




## Parameters




+ ` \ KeyedContainer<\Tk, \Tv> $container `
+ ` \ Traversable<\Tk> $keys `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
