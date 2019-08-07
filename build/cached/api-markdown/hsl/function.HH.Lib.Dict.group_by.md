``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\group_by",
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




Returns a new dict where

+ keys are the results of the given function called on the given values




``` Hack
namespace HH\Lib\Dict;

function group_by<\Tk as arraykey, \Tv>(
  \  Traversable<\Tv> $values,
  \callable $key_func,
): dict<\Tk, vec<\Tv>>;
```




* values are vecs of original values that all produced the same key.




If a value produces a null key, it's omitted from the result.




Time complexity: O(n * f), where f is the complexity of ` $key_func `
Space complexity: O(n)




## Parameters




- ` \ Traversable<\Tv> $values `
- ` \callable $key_func `




## Returns




+ ` dict<\Tk, vec<\Tv>> `
<!-- HHAPIDOC -->
