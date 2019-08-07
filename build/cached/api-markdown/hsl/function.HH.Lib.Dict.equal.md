``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\equal",
    "sources": [
        "api-sources/hsl/src/dict/introspect.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns whether the two given dicts have the same entries, using strict
equality




``` Hack
namespace HH\Lib\Dict;

function equal<\Tk as arraykey, \Tv>(
  dict<\Tk, \Tv> $dict1,
  dict<\Tk, \Tv> $dict2,
): bool;
```




To guarantee equality of order as well as contents, use ` === `.




Time complexity: O(n)
Space complexity: O(1)




## Parameters




+ ` dict<\Tk, \Tv> $dict1 `
+ ` dict<\Tk, \Tv> $dict2 `




## Returns




* ` bool `
<!-- HHAPIDOC -->
