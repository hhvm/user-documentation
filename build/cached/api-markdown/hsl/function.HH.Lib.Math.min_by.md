``` yamlmeta
{
    "name": "HH\\Lib\\Math\\min_by",
    "sources": [
        "api-sources/hsl/src/math/containers.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the smallest element of the given Traversable, or null if the
Traversable is empty




``` Hack
namespace HH\Lib\Math;

function min_by<\T>(
  \  Traversable<\T> $traversable,
  \callable $num_func,
): ?\T;
```




The value for comparison is determined by the given function. In the case of
duplicate numeric keys, later values overwrite previous ones.




For numeric elements, see ` Math\min() `.




## Parameters




+ ` \ Traversable<\T> $traversable `
+ ` \callable $num_func `




## Returns




* ` ?\T `
<!-- HHAPIDOC -->
