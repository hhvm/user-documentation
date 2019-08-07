``` yamlmeta
{
    "name": "HH\\Lib\\Math\\max",
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




Returns the largest element of the given Traversable, or null if the
Traversable is empty




``` Hack
namespace HH\Lib\Math;

function max<\T as num>(
  \  Traversable<\T> $numbers,
): ?\T;
```




+ For a known number of inputs, see ` Math\maxva() `.
+ To find the smallest number, see ` Math\min() `.




## Parameters




* ` \ Traversable<\T> $numbers `




## Returns




- ` ?\T `
<!-- HHAPIDOC -->
