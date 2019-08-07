``` yamlmeta
{
    "name": "HH\\Lib\\Math\\from_base",
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




Converts the given string in the given base to an int, assuming letters a-z
are used for digits when ` $from_base ` > 10




``` Hack
namespace HH\Lib\Math;

function from_base(
  string $number,
  int $from_base,
): int;
```




To base convert an int into a string, see ` Math\to_base() `.




## Parameters




+ ` string $number `
+ ` int $from_base `




## Returns




* ` int `
<!-- HHAPIDOC -->
