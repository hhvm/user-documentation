``` yamlmeta
{
    "name": "HH\\Lib\\Math\\sum",
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




Returns the integer sum of the values of the given Traversable




``` Hack
namespace HH\Lib\Math;

function sum(
  \  Traversable<int> $traversable,
): int;
```




For a float sum, see ` Math\sum_float() `.




## Parameters




+ ` \ Traversable<int> $traversable `




## Returns




* ` int `
<!-- HHAPIDOC -->
