``` yamlmeta
{
    "name": "HH\\Lib\\Str\\compare",
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
greater than ```` $string2 ````, and 0 if they are equal




``` Hack
namespace HH\Lib\Str;

function compare(
  string $string1,
  string $string2,
): int;
```




For a case-insensitive comparison, see ` Str\compare_ci() `.




## Parameters




+ ` string $string1 `
+ ` string $string2 `




## Returns




* ` int `
<!-- HHAPIDOC -->
