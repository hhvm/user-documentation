``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\equal",
    "sources": [
        "api-sources/hsl/src/keyset/introspect.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns whether the two given keysets have the same elements, using strict
equality




``` Hack
namespace HH\Lib\Keyset;

function equal<\Tv as arraykey>(
  keyset<\Tv> $keyset1,
  keyset<\Tv> $keyset2,
): bool;
```




To guarantee equality of order as well as contents, use ` === `.




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` keyset<\Tv> $keyset1 `
+ ` keyset<\Tv> $keyset2 `




## Returns




* ` bool `
<!-- HHAPIDOC -->
