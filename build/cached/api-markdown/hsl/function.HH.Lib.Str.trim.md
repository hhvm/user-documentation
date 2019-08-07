``` yamlmeta
{
    "name": "HH\\Lib\\Str\\trim",
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




Returns the given string with whitespace stripped from the beginning and end




``` Hack
namespace HH\Lib\Str;

function trim(
  string $string,
  ?string $char_mask = NULL,
): string;
```




If the optional character mask isn't provided, the following characters will
be stripped: space, tab, newline, carriage return, NUL byte, vertical tab.




+ To only strip from the left, see ` Str\trim_left() `.
+ To only strip from the right, see ` Str\trim_right() `.




## Parameters




* ` string $string `
* ` ?string $char_mask = NULL `




## Returns




- ` string `
<!-- HHAPIDOC -->
