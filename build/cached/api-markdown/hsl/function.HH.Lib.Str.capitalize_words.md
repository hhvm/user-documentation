``` yamlmeta
{
    "name": "HH\\Lib\\Str\\capitalize_words",
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




Returns the string with all words capitalized




``` Hack
namespace HH\Lib\Str;

function capitalize_words(
  string $string,
  string $delimiters = ' \\t\\r\\n\\f\\v',
): string;
```




Words are delimited by space, tab, newline, carriage return, form-feed, and
vertical tab by default, but you can specify custom delimiters.




+ To capitalize all characters, see ` Str\uppercase() `.
+ To capitalize only the first character, see ` Str\capitalize() `.




## Parameters




* ` string $string `
* ` string $delimiters = ' \\t\\r\\n\\f\\v' `




## Returns




- ` string `
<!-- HHAPIDOC -->
