``` yamlmeta
{
    "name": "HH\\Lib\\Str\\pad_left",
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




Returns the string padded to the total length by appending the ` $pad_string `
to the left




``` Hack
namespace HH\Lib\Str;

function pad_left(
  string $string,
  int $total_length,
  string $pad_string = ' ',
): string;
```




If the length of the input string plus the pad string exceeds the total
length, the pad string will be truncated. If the total length is less than or
equal to the length of the input string, no padding will occur.




To pad the string on the right, see ` Str\pad_right() `.




## Parameters




+ ` string $string `
+ ` int $total_length `
+ ` string $pad_string = ' ' `




## Returns




* ` string `
<!-- HHAPIDOC -->
