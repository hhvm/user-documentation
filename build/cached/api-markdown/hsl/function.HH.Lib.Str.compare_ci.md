``` yamlmeta
{
    "name": "HH\\Lib\\Str\\compare_ci",
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




Returns < 0 if ` $string1 ` is less than `` $string2 ``, > 0 if ``` $string1 ``` is
greater than ```` $string2 ````, and 0 if they are equal (case-insensitive)




``` Hack
namespace HH\Lib\Str;

function compare_ci(
  string $string1,
  string $string2,
): int;
```




For a case-sensitive comparison, see ` Str\compare() `.




## Parameters




+ ` string $string1 `
+ ` string $string2 `




## Returns




* ` int `
<!-- HHAPIDOC -->
