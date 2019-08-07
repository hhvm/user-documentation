``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\filter_with_key",
    "sources": [
        "api-sources/hsl/src/keyset/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset containing only the values for which the given predicate
returns ` true `




``` Hack
namespace HH\Lib\Keyset;

function filter_with_key<\Tk, \Tv as arraykey>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $predicate,
): keyset<\Tv>;
```




If you don't need access to the key, see ` Keyset\filter() `.




Time complexity: O(n * p), where p is the complexity of ` $predicate `
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
