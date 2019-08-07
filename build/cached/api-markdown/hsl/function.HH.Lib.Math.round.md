``` yamlmeta
{
    "name": "HH\\Lib\\Math\\round",
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




Returns the given number rounded to the specified precision




``` Hack
namespace HH\Lib\Math;

function round(
  num $val,
  int $precision = 0,
): float;
```




A positive
precision rounds to the nearest decimal place whereas a negative precision
rounds to the nearest power of ten. For example, a precision of 1 rounds to
the nearest tenth whereas a precision of -1 rounds to the nearest ten.




## Parameters




+ ` num $val `
+ ` int $precision = 0 `




## Returns




* ` float `
<!-- HHAPIDOC -->
