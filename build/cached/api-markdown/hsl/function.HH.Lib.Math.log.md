``` yamlmeta
{
    "name": "HH\\Lib\\Math\\log",
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




Returns the logarithm base ` $base ` of `` $arg ``




``` Hack
namespace HH\Lib\Math;

function log(
  num $arg,
  ?num $base = NULL,
): float;
```




For the exponential function, see ` Math\exp() `.




## Parameters




+ ` num $arg `
+ ` ?num $base = NULL `




## Returns




* ` float `
<!-- HHAPIDOC -->
