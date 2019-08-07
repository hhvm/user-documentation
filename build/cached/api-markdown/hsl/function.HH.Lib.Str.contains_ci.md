``` yamlmeta
{
    "name": "HH\\Lib\\Str\\contains_ci",
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




Returns whether the "haystack" string contains the "needle" string
(case-insensitive)




``` Hack
namespace HH\Lib\Str;

function contains_ci(
  string $haystack,
  string $needle,
  int $offset = 0,
): bool;
```




An optional offset determines where in the haystack the search begins. If the
offset is negative, the search will begin that many characters from the end
of the string. If the offset is out-of-bounds, a ViolationException will be
thrown.




+ To search for the needle case-sensitively, see ` Str\contains() `.
+ To get the position of the needle case-insensitively, see ` Str\search_ci() `.




## Parameters




* ` string $haystack `
* ` string $needle `
* ` int $offset = 0 `




## Returns




- ` bool `
<!-- HHAPIDOC -->
