``` yamlmeta
{
    "name": "HH\\Lib\\Math\\sum_float",
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




Returns the float sum of the values of the given Traversable




``` Hack
namespace HH\Lib\Math;

function sum_float<\T as num>(
  \  Traversable<\T> $traversable,
): float;
```




For an integer sum, see ` Math\sum() `.




## Parameters




+ ` \ Traversable<\T> $traversable `




## Returns




* ` float `
<!-- HHAPIDOC -->
