``` yamlmeta
{
    "name": "HH\\Lib\\Str\\ends_with_ci",
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




Returns whether the string ends with the given suffix (case-insensitive)




``` Hack
namespace HH\Lib\Str;

function ends_with_ci(
  string $string,
  string $suffix,
): bool;
```




For a case-sensitive check, see ` Str\ends_with() `.




## Parameters




+ ` string $string `
+ ` string $suffix `




## Returns




* ` bool `
<!-- HHAPIDOC -->
