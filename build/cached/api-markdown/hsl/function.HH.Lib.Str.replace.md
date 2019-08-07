``` yamlmeta
{
    "name": "HH\\Lib\\Str\\replace",
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




Returns the "haystack" string with all occurrences of ` $needle ` replaced by
`` $replacement ``




``` Hack
namespace HH\Lib\Str;

function replace(
  string $haystack,
  string $needle,
  string $replacement,
): string;
```




+ For a case-insensitive search/replace, see ` Str\replace_ci() `.
+ For multiple case-sensitive searches/replacements, see ` Str\replace_every() `.
+ For multiple case-insensitive searches/replacements, see ` Str\replace_every_ci() `.




## Parameters




* ` string $haystack `
* ` string $needle `
* ` string $replacement `




## Returns




- ` string `
<!-- HHAPIDOC -->
