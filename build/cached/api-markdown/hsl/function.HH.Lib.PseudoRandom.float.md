``` yamlmeta
{
    "name": "HH\\Lib\\PseudoRandom\\float",
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




Returns a pseudorandom float in the range from 0




``` Hack
namespace HH\Lib\PseudoRandom;

function float(): float;
```




0 to 1.0, inclusive. This is
NOT suitable for cryptographic uses.




For secure random floats, see ` SecureRandom\float `.




## Returns




+ ` float `
<!-- HHAPIDOC -->
