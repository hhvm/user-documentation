``` yamlmeta
{
    "name": "HH\\Lib\\Math\\ceil",
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




Returns the smallest integer value greater than or equal to $value




``` Hack
namespace HH\Lib\Math;

function ceil(
  num $value,
): float;
```




To find the largest integer value less than or equal to ` $value `, see
`` Math\floor() ``.




## Parameters




+ ` num $value `




## Returns




* ` float `
<!-- HHAPIDOC -->
