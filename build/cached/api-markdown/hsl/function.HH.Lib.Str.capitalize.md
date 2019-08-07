``` yamlmeta
{
    "name": "HH\\Lib\\Str\\capitalize",
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




Returns the string with the first character capitalized




``` Hack
namespace HH\Lib\Str;

function capitalize(
  string $string,
): string;
```




If the first character is already capitalized or isn't alphabetic, the string
will be unchanged.




+ To capitalize all characters, see ` Str\uppercase() `.
+ To capitalize all words, see ` Str\capitalize_words() `.




## Parameters




* ` string $string `




## Returns




- ` string `
<!-- HHAPIDOC -->
