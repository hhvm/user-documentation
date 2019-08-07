``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\filter",
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




Returns a new dict containing only the values for which the given predicate
returns ` true `




``` Hack
namespace HH\Lib\Dict;

function filter<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
  ?\callable $value_predicate = NULL,
): dict<\Tk, \Tv>;
```




The default predicate is casting the value to boolean.




+ To remove null values in a typechecker-visible way, see ` Dict\filter_nulls() `.
+ To use an async predicate, see ` Dict\filter_async() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
(which is O(1) if not provided explicitly)
Space complexity: O(n)




## Parameters




* ` \ KeyedTraversable<\Tk, \Tv> $traversable `
* ` ?\callable $value_predicate = NULL `




## Returns




- ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
