``` yamlmeta
{
    "name": "HH\\Lib\\Str\\format_number",
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




Returns a string representation of the given number with grouped thousands




``` Hack
namespace HH\Lib\Str;

function format_number(
  num $number,
  int $decimals = 0,
  string $decimal_point = '.',
  string $thousands_separator = ',',
): string;
```




If ` $decimals ` is provided, the string will contain that many decimal places.
The optional `` $decimal_point `` and ``` $thousands_separator ``` arguments define the
strings used for decimals and commas, respectively.




## Parameters




+ ` num $number `
+ ` int $decimals = 0 `
+ ` string $decimal_point = '.' `
+ ` string $thousands_separator = ',' `




## Returns




* ` string `
<!-- HHAPIDOC -->
