``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\filter_nulls",
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




Returns a new keyset containing only non-null values of the given
Traversable




``` Hack
namespace HH\Lib\Keyset;

function filter_nulls<\Tv as arraykey>(
  \  Traversable<?\Tv> $traversable,
): keyset<\Tv>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ Traversable<?\Tv> $traversable `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
