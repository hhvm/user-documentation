``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\filter_with_key",
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




Returns a new vec containing only the values for which the given predicate
returns ` true `




``` Hack
namespace HH\Lib\Vec;

function filter_with_key<\Tk, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $predicate,
): vec<\Tv>;
```




If you don't need access to the key, see ` Vec\filter() `.




Time complexity: O(n * p), where p is the complexity of ` $predicate `
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
