``` yamlmeta
{
    "name": "HH\\Lib\\C\\first_key",
    "sources": [
        "api-sources/hsl/src/c/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the first key of the given KeyedTraversable, or null if the
KeyedTraversable is empty




``` Hack
namespace HH\Lib\C;

function first_key<\Tk, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): ?\Tk;
```




For non-empty Traversables, see ` C\first_keyx `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` ?\Tk `
<!-- HHAPIDOC -->
