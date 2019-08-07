``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\filter_with_key",
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




Just like filter, but your predicate can include the key as well as
the value




``` Hack
namespace HH\Lib\Dict;

function filter_with_key<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  \callable $predicate,
): dict<\Tk, \Tv>;
```




To use an async predicate, see ` Dict\filter_with_key_async() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
(which is O(1) if not provided explicitly)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `
+ ` \callable $predicate `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
