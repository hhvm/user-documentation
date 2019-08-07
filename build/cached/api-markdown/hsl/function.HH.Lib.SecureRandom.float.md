``` yamlmeta
{
    "name": "HH\\Lib\\SecureRandom\\float",
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




Returns a cryptographically secure random float in the range from 0




``` Hack
namespace HH\Lib\SecureRandom;

function float(): float;
```




0 to 1.0,
inclusive.




For pseudorandom floats, see ` PseudoRandom\float `.




## Returns




+ ` float `
<!-- HHAPIDOC -->
