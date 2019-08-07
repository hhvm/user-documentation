``` yamlmeta
{
    "name": "HH\\Lib\\Math\\maxva",
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




Returns the largest of all input numbers




``` Hack
namespace HH\Lib\Math;

function maxva<\T as num>(
  \T $first,
  \T $second,
  \T ...$rest,
): \T;
```




+ To find the smallest number, see ` Math\minva() `.
+ For Traversables, see ` Math\max() `.




## Parameters




* ` \T $first `
* ` \T $second `
* ` \T ...$rest `




## Returns




- ` \T `
<!-- HHAPIDOC -->
