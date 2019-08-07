``` yamlmeta
{
    "name": "HH\\Lib\\SecureRandom\\string",
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




Returns a securely generated random string of length ` $length `




``` Hack
namespace HH\Lib\SecureRandom;

function string(
  int $length,
  ?string $alphabet = NULL,
): string;
```




The string is
composed of characters from ` $alphabet ` if `` $alphabet `` is specified.




For pseudorandom strings, see ` PseudoRandom\string `.




## Parameters




+ ` int $length `
+ ` ?string $alphabet = NULL `




## Returns




* ` string `
<!-- HHAPIDOC -->
