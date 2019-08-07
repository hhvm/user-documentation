``` yamlmeta
{
    "name": "HH\\Lib\\Str\\strip_suffix",
    "sources": [
        "api-sources/hsl/src/str/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the string with the given suffix removed, or the string itself if
it doesn't end with the suffix




``` Hack
namespace HH\Lib\Str;

function strip_suffix(
  string $string,
  string $suffix,
): string;
```




## Parameters




+ ` string $string `
+ ` string $suffix `




## Returns




* ` string `
<!-- HHAPIDOC -->
