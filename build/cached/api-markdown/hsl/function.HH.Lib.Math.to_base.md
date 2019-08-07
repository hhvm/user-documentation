``` yamlmeta
{
    "name": "HH\\Lib\\Math\\to_base",
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




Converts the given non-negative number into the given base, using letters a-z
for digits when ` $to_base ` > 10




``` Hack
namespace HH\Lib\Math;

function to_base(
  int $number,
  int $to_base,
): string;
```




To base convert a string to an int, see ` Math\from_base() `.




## Parameters




+ ` int $number `
+ ` int $to_base `




## Returns




* ` string `
<!-- HHAPIDOC -->
