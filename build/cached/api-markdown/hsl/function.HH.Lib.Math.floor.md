``` yamlmeta
{
    "name": "HH\\Lib\\Math\\floor",
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




Returns the largest integer value less than or equal to ` $value `




``` Hack
namespace HH\Lib\Math;

function floor(
  num $value,
): float;
```




+ To find the smallest integer value greater than or equal to ` $value `, see
  `` Math\ceil() ``.
+ To find the largest integer value less than or equal to a ratio, see
  ` Math\int_div() `.




## Parameters




* ` num $value `




## Returns




- ` float `
<!-- HHAPIDOC -->
