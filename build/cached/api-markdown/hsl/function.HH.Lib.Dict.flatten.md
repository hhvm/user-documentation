``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\flatten",
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




Returns a new dict formed by merging the KeyedTraversable elements of the
given Traversable




``` Hack
namespace HH\Lib\Dict;

function flatten<\Tk as arraykey, \Tv>(
  \  Traversable<KeyedContainer<\Tk, \Tv>> $traversables,
): dict<\Tk, \Tv>;
```




In the case of duplicate keys, later values will overwrite
the previous ones.




For a fixed number of KeyedTraversables, see ` Dict\merge() `.




Time complexity: O(n), where n is the combined size of all the
` $traversables `
Space complexity: O(n), where n is the combined size of all the
`` $traversables ``




## Parameters




+ ` \ Traversable<KeyedContainer<\Tk, \Tv>> $traversables `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
