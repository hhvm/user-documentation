``` yamlmeta
{
    "name": "HH\\Lib\\C\\last_key",
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




Returns the last key of the given KeyedTraversable, or null if the
KeyedTraversable is empty




``` Hack
namespace HH\Lib\C;

function last_key<\Tk, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $traversable,
): ?\Tk;
```




For non-empty Traversables, see ` C\last_keyx `.




Time complexity: O(1) if ` $traversable ` is a `` Container ``, O(n) otherwise.
Space complexity: O(1)




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $traversable `




## Returns




* ` ?\Tk `
<!-- HHAPIDOC -->
