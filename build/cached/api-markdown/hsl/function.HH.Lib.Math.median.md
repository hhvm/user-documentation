``` yamlmeta
{
    "name": "HH\\Lib\\Math\\median",
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




Returns the median of the given numbers




``` Hack
namespace HH\Lib\Math;

function median(
  Container<num> $numbers,
): ?float;
```




To find the mean, see ` Math\mean() `.




## Parameters




+ ` Container<num> $numbers `




## Returns




* ` ?float `
<!-- HHAPIDOC -->
