``` yamlmeta
{
    "name": "HH\\Lib\\Str\\replace_every_ci",
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




Returns the "haystack" string with all occurrences of the keys of
` $replacements ` replaced by the corresponding values (case-insensitive)




``` Hack
namespace HH\Lib\Str;

function replace_every_ci(
  string $haystack,
  \  KeyedContainer<string, string> $replacements,
): string;
```




+ For a single case-sensitive search/replace, see ` Str\replace() `.
+ For a single case-insensitive search/replace, see ` Str\replace_ci() `.
+ For multiple case-sensitive searches/replacements, see ` Str\replace_every() `.




## Parameters




* ` string $haystack `
* ` \ KeyedContainer<string, string> $replacements `




## Returns




- ` string `
<!-- HHAPIDOC -->
