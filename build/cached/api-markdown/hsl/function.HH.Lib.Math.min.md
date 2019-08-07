``` yamlmeta
{
    "name": "HH\\Lib\\Math\\min",
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




Returns the smallest element of the given Traversable, or null if the
Traversable is empty




``` Hack
namespace HH\Lib\Math;

function min<\T as num>(
  \  Traversable<\T> $numbers,
): ?\T;
```




+ For a known number of inputs, see ` Math\minva() `.
+ To find the largest number, see ` Math\max() `.




## Parameters




* ` \ Traversable<\T> $numbers `




## Returns




- ` ?\T `
<!-- HHAPIDOC -->
