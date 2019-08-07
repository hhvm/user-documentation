``` yamlmeta
{
    "name": "HH\\Lib\\C\\lastx",
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




Returns the last element of the given Traversable, or throws if the
Traversable is empty




``` Hack
namespace HH\Lib\C;

function lastx<\T>(
  \  Traversable<\T> $traversable,
): \T;
```




+ For possibly empty Traversables, see ` C\last `.
+ For single-element Traversables, see ` C\onlyx `.




Time complexity: O(1) if ` $traversable ` is a `` Container ``, O(n) otherwise.
Space complexity: O(1)




## Parameters




* ` \ Traversable<\T> $traversable `




## Returns




- ` \T `
<!-- HHAPIDOC -->
