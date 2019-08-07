``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\filter",
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

function filter<\Tv as arraykey>(
  \  Traversable<\Tv> $traversable,
  ?\callable $value_predicate = NULL,
): keyset<\Tv>;
```




The default predicate is casting the value to boolean.




To remove null values in a typechecker-visible way, see ` Keyset\filter_nulls() `.




Time complexity: O(n * p), where p is the complexity of ` $value_predicate `
Space complexity: O(n)




## Parameters




+ ` \ Traversable<\Tv> $traversable `
+ ` ?\callable $value_predicate = NULL `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
