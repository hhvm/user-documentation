``` yamlmeta
{
    "name": "HH\\Lib\\C\\first_keyx",
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




Returns the first key of the given KeyedTraversable, or throws if the
KeyedTraversable is empty




``` Hack
namespace HH\Lib\C;

function first_keyx<\Tk, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): \Tk;
```




For possibly empty Traversables, see ` C\first_key `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` \Tk `
<!-- HHAPIDOC -->
