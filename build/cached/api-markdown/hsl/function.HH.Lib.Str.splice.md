``` yamlmeta
{
    "name": "HH\\Lib\\Str\\splice",
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




Return the string with a slice specified by the offset/length replaced by the
given replacement string




``` Hack
namespace HH\Lib\Str;

function splice(
  string $string,
  string $replacement,
  int $offset,
  ?int $length = NULL,
): string;
```




If the length is omitted or exceeds the upper bound of the string, the
remainder of the string will be replaced. If the length is zero, the
replacement will be inserted at the offset.




Previously known in PHP as ` substr_replace `.




## Parameters




+ ` string $string `
+ ` string $replacement `
+ ` int $offset `
+ ` ?int $length = NULL `




## Returns




* ` string `
<!-- HHAPIDOC -->
