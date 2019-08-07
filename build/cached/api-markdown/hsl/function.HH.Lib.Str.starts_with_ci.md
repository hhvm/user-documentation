``` yamlmeta
{
    "name": "HH\\Lib\\Str\\starts_with_ci",
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




Returns whether the string starts with the given prefix (case-insensitive)




``` Hack
namespace HH\Lib\Str;

function starts_with_ci(
  string $string,
  string $prefix,
): bool;
```




For a case-sensitive check, see ` Str\starts_with() `.




## Parameters




+ ` string $string `
+ ` string $prefix `




## Returns




* ` bool `
<!-- HHAPIDOC -->
