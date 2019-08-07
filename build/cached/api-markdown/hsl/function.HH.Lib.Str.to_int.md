``` yamlmeta
{
    "name": "HH\\Lib\\Str\\to_int",
    "sources": [
        "api-sources/hsl/src/str/transform.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the given string as an integer, or null if the string isn't numeric




``` Hack
namespace HH\Lib\Str;

function to_int(
  string $string,
): ?int;
```




## Parameters




+ ` string $string `




## Returns




* ` ?int `
<!-- HHAPIDOC -->
