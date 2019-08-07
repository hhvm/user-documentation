``` yamlmeta
{
    "name": "HH\\Lib\\Str\\starts_with",
    "sources": [
        "api-sources/hsl/src/str/introspect.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns whether the string starts with the given prefix




``` Hack
namespace HH\Lib\Str;

function starts_with(
  string $string,
  string $prefix,
): bool;
```




For a case-insensitive check, see ` Str\starts_with_ci() `.




## Parameters




+ ` string $string `
+ ` string $prefix `




## Returns




* ` bool `
<!-- HHAPIDOC -->
