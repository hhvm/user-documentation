``` yamlmeta
{
    "name": "HH\\Lib\\Regex\\to_string",
    "sources": [
        "api-sources/hsl/src/regex/regex.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Renders a Regex Pattern to a string




``` Hack
namespace HH\Lib\Regex;

function to_string<\T as HH\Lib\Regex\Match>(
  \  Pattern<\T> $pattern,
): string;
```




## Parameters




+ ` \ Pattern<\T> $pattern `




## Returns




* ` string `
<!-- HHAPIDOC -->
