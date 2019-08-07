``` yamlmeta
{
    "name": "HH\\Lib\\Str\\trim_left",
    "sources": [
        "api-sources/hsl/src/str/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns the given string with whitespace stripped from the left




``` Hack
namespace HH\Lib\Str;

function trim_left(
  string $string,
  ?string $char_mask = NULL,
): string;
```




See ` Str\trim() ` for more details.




+ To strip from both ends, see ` Str\trim() `.
+ To only strip from the right, see ` Str\trim_right() `




## Parameters




* ` string $string `
* ` ?string $char_mask = NULL `




## Returns




- ` string `
<!-- HHAPIDOC -->
