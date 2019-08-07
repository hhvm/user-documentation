``` yamlmeta
{
    "name": "HH\\Lib\\Str\\pad_right",
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
to the right




``` Hack
namespace HH\Lib\Str;

function pad_right(
  string $string,
  int $total_length,
  string $pad_string = ' ',
): string;
```




If the length of the input string plus the pad string exceeds the total
length, the pad string will be truncated. If the total length is less than or
equal to the length of the input string, no padding will occur.




To pad the string on the left, see ` Str\pad_left() `.




## Parameters




+ ` string $string `
+ ` int $total_length `
+ ` string $pad_string = ' ' `




## Returns




* ` string `
<!-- HHAPIDOC -->
