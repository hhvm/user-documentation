``` yamlmeta
{
    "name": "HH\\Lib\\Str\\search_last",
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




Returns the last position of the "needle" string in the "haystack" string,
or null if it isn't found




``` Hack
namespace HH\Lib\Str;

function search_last(
  string $haystack,
  string $needle,
  int $offset = 0,
): ?int;
```




An optional offset determines where in the haystack (from the beginning) the
search begins. If the offset is negative, the search will begin that many
characters from the end of the string and go backwards. If the offset is
out-of-bounds, a ViolationException will be thrown.




+ To simply check if the haystack contains the needle, see ` Str\contains() `.
+ To get the first position of the needle, see ` Str\search() `.




Previously known in PHP as ` strrpos `.




## Parameters




* ` string $haystack `
* ` string $needle `
* ` int $offset = 0 `




## Returns




- ` ?int `
<!-- HHAPIDOC -->
