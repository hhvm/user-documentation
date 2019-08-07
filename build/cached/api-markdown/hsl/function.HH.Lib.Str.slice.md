``` yamlmeta
{
    "name": "HH\\Lib\\Str\\slice",
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




Returns a substring of length ` $length ` of the given string starting at the
`` $offset ``




``` Hack
namespace HH\Lib\Str;

function slice(
  string $string,
  int $offset,
  ?int $length = NULL,
): string;
```




If no length is given, the slice will contain the rest of the
string. If the length is zero, the empty string will be returned. If the
offset is out-of-bounds, a ViolationException will be thrown.




Previously known as ` substr ` in PHP.




## Parameters




+ ` string $string `
+ ` int $offset `
+ ` ?int $length = NULL `




## Returns




* ` string `
<!-- HHAPIDOC -->
