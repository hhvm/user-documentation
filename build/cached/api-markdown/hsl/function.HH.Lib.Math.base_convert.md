``` yamlmeta
{
    "name": "HH\\Lib\\Math\\base_convert",
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




Converts the given string in base ` $from_base ` to base `` $to_base ``, assuming
letters a-z are used for digits for bases greater than 10




``` Hack
namespace HH\Lib\Math;

function base_convert(
  string $value,
  int $from_base,
  int $to_base,
): string;
```




The conversion is
done to arbitrary precision.




+ To convert a string in some base to an int, see ` Math\from_base() `.
+ To convert an int to a string in some base, see ` Math\to_base() `.




## Parameters




* ` string $value `
* ` int $from_base `
* ` int $to_base `




## Returns




- ` string `
<!-- HHAPIDOC -->
