``` yamlmeta
{
    "name": "HH\\Lib\\Str\\strip_prefix",
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




Returns the string with the given prefix removed, or the string itself if
it doesn't start with the prefix




``` Hack
namespace HH\Lib\Str;

function strip_prefix(
  string $string,
  string $prefix,
): string;
```




## Parameters




+ ` string $string `
+ ` string $prefix `




## Returns




* ` string `
<!-- HHAPIDOC -->
