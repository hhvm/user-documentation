``` yamlmeta
{
    "name": "HH\\Lib\\C\\nfirst",
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




Returns the first element of the given Traversable, or null if the
Traversable is null or empty




``` Hack
namespace HH\Lib\C;

function nfirst<\T>(
  ?Traversable<\T> $traversable,
): ?\T;
```




+ For non-null Traversables, see ` C\first `.
+ For non-empty Traversables, see ` C\firstx `.
+ For single-element Traversables, see ` C\onlyx `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




* ` ?Traversable<\T> $traversable `




## Returns




- ` ?\T `
<!-- HHAPIDOC -->
