``` yamlmeta
{
    "name": "HH\\Lib\\Math\\mean",
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




Returns the arithmetic mean of the numbers in the given container




``` Hack
namespace HH\Lib\Math;

function mean(
  Container<num> $numbers,
): ?float;
```




+ To find the sum, see ` Math\sum() `.
+ To find the maximum, see ` Math\max() `.
+ To find the minimum, see ` Math\min() `.




## Parameters




* ` Container<num> $numbers `




## Returns




- ` ?float `
<!-- HHAPIDOC -->
