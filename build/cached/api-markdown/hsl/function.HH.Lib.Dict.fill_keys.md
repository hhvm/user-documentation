``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\fill_keys",
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




Returns a new dict where all the given keys map to the given value




``` Hack
namespace HH\Lib\Dict;

function fill_keys<\Tk as arraykey, \Tv>(
  \  Traversable<\Tk> $keys,
  \Tv $value,
): dict<\Tk, \Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tk> $keys `
+ ` \Tv $value `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
