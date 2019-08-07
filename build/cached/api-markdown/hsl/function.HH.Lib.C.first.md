``` yamlmeta
{
    "name": "HH\\Lib\\C\\first",
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
Traversable is empty




``` Hack
namespace HH\Lib\C;

function first<\T>(
  \  Traversable<\T> $traversable,
): ?\T;
```




+ For non-empty Traversables, see ` C\firstx `.
+ For possibly null Traversables, see ` C\nfirst `.
+ For single-element Traversables, see ` C\onlyx `.
+ For Awaitables that yield Traversables, see ` C\first_async `.




Time complexity: O(1)
Space complexity: O(1)




## Parameters




* ` \ Traversable<\T> $traversable `




## Returns




- ` ?\T `
<!-- HHAPIDOC -->
