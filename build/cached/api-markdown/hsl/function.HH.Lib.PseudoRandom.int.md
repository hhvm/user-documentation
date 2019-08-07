``` yamlmeta
{
    "name": "HH\\Lib\\PseudoRandom\\int",
    "sources": [
        "api-sources/hsl/src/random/pseudo.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a pseudorandom integer in the range from ` $min ` to `` $max ``, inclusive




``` Hack
namespace HH\Lib\PseudoRandom;

function int(
  int $min = \PHP_INT_MIN,
  int $max = \PHP_INT_MAX,
): int;
```




This is NOT suitable for cryptographic uses.




For secure random integers, see ` SecureRandom\int `.




## Parameters




+ ` int $min = \PHP_INT_MIN `
+ ` int $max = \PHP_INT_MAX `




## Returns




* ` int `
<!-- HHAPIDOC -->
