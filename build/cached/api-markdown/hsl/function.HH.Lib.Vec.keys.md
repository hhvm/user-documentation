``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\keys",
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




Returns a new vec containing the keys of the given KeyedTraversable




``` Hack
namespace HH\Lib\Vec;

function keys<\Tk, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): vec<\Tk>;
```




Time complexity: O(n)
Space complexity: O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` vec<\Tk> `
<!-- HHAPIDOC -->
