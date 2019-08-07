``` yamlmeta
{
    "name": "HH\\Lib\\SecureRandom\\int",
    "sources": [
        "api-sources/hsl/src/random/secure.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a cryptographically secure random integer in the range from ` $min ` to
`` $max ``, inclusive




``` Hack
namespace HH\Lib\SecureRandom;

function int(
  int $min = \PHP_INT_MIN,
  int $max = \PHP_INT_MAX,
): int;
```




For pseudorandom integers, see ` PseudoRandom\int `.




## Parameters




+ ` int $min = \PHP_INT_MIN `
+ ` int $max = \PHP_INT_MAX `




## Returns




* ` int `
<!-- HHAPIDOC -->
