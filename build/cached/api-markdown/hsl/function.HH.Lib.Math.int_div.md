``` yamlmeta
{
    "name": "HH\\Lib\\Math\\int_div",
    "sources": [
        "api-sources/hsl/src/math/compute.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the result of integer division of ` $numerator ` by `` $denominator ``




``` Hack
namespace HH\Lib\Math;

function int_div(
  int $numerator,
  int $denominator,
): int;
```




To round a single value, see ` Math\floor() `.




## Parameters




+ ` int $numerator `
+ ` int $denominator `




## Returns




* ` int `
<!-- HHAPIDOC -->
