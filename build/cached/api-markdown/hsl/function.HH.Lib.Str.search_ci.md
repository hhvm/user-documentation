``` yamlmeta
{
    "name": "HH\\Lib\\Str\\search_ci",
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




Returns the first position of the "needle" string in the "haystack" string,
or null if it isn't found (case-insensitive)




``` Hack
namespace HH\Lib\Str;

function search_ci(
  string $haystack,
  string $needle,
  int $offset = 0,
): ?int;
```




An optional offset determines where in the haystack the search begins. If the
offset is negative, the search will begin that many characters from the end
of the string. If the offset is out-of-bounds, a ViolationException will be
thrown.




+ To simply check if the haystack contains the needle, see ` Str\contains() `.
+ To get the case-sensitive position, see ` Str\search() `.
+ To get the last position of the needle, see ` Str\search_last() `.




Previously known in PHP as ` stripos `.




## Parameters




* ` string $haystack `
* ` string $needle `
* ` int $offset = 0 `




## Returns




- ` ?int `
<!-- HHAPIDOC -->
