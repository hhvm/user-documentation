``` yamlmeta
{
    "name": "HH\\Lib\\Str\\repeat",
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




Returns the input string repeated ` $multiplier ` times




``` Hack
namespace HH\Lib\Str;

function repeat(
  string $string,
  int $multiplier,
): string;
```




If the multiplier is 0, the empty string will be returned.




## Parameters




+ ` string $string `
+ ` int $multiplier `




## Returns




* ` string `
<!-- HHAPIDOC -->
