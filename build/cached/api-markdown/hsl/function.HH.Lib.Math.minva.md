``` yamlmeta
{
    "name": "HH\\Lib\\Math\\minva",
    "sources": [
        "api-sources/hsl/src/math/compare.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the smallest of all input numbers




``` Hack
namespace HH\Lib\Math;

function minva<\T as num>(
  \T $first,
  \T $second,
  \T ...$rest,
): \T;
```




+ To find the largest number, see ` Math\maxva() `.
+ For Traversables, see ` Math\min() `.




## Parameters




* ` \T $first `
* ` \T $second `
* ` \T ...$rest `




## Returns




- ` \T `
<!-- HHAPIDOC -->
