``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\unique_by",
    "sources": [
        "api-sources/hsl/src/vec/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec containing each element of the given Traversable exactly
once, where uniqueness is determined by calling the given scalar function on
the values




``` Hack
namespace HH\Lib\Vec;

function unique_by<\Tv, \Ts as arraykey>(
  \  Traversable<\Tv> $traversable,
  \callable $scalar_func,
): vec<\Tv>;
```




In case of duplicate scalar keys, later values will overwrite
previous ones.




For arraykey elements, see ` Vec\unique() `.




Time complexity: O(n * s), where s is the complexity of ` $scalar_func `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` \callable $scalar_func `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
