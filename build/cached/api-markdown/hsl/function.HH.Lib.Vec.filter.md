``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\filter",
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

function filter<\Tv>(
  \  Traversable<\Tv> $traversable,
  ?\callable $value_predicate = NULL,
): vec<\Tv>;
```




The default predicate is casting the value to boolean.




+ To remove null values in a typechecker-visible way, see
  ` Vec\filter_nulls() `.
+ To use an async predicate, see ` Vec\filter_async() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
Space complexity: O(n)




## Parameters




* ` \ Traversable<\Tv> $traversable `
* ` ?\callable $value_predicate = NULL `




## Returns




- ` vec<\Tv> `
<!-- HHAPIDOC -->
