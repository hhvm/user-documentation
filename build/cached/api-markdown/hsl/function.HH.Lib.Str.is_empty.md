``` yamlmeta
{
    "name": "HH\\Lib\\Str\\is_empty",
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




Returns ` true ` if `` $string `` is null or the empty string




``` Hack
namespace HH\Lib\Str;

function is_empty(
  ?string $string,
): bool;
```




Returns ` false ` otherwise.




## Parameters




+ ` ?string $string `




## Returns




* ` bool `
<!-- HHAPIDOC -->
