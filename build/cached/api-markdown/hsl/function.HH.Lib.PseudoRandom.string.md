``` yamlmeta
{
    "name": "HH\\Lib\\PseudoRandom\\string",
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




Returns a pseudorandom string of length ` $length `




``` Hack
namespace HH\Lib\PseudoRandom;

function string(
  int $length,
  ?string $alphabet = NULL,
): string;
```




The string is composed of
characters from ` $alphabet ` if `` $alphabet `` is specified. This is NOT suitable
for cryptographic uses.




For secure random strings, see ` SecureRandom\string `.




## Parameters




+ ` int $length `
+ ` ?string $alphabet = NULL `




## Returns




* ` string `
<!-- HHAPIDOC -->
