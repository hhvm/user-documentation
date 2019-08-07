``` yamlmeta
{
    "name": "HH\\Lib\\Str\\chunk",
    "sources": [
        "api-sources/hsl/src/str/divide.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a vec containing the string split into chunks of the given size




``` Hack
namespace HH\Lib\Str;

function chunk(
  string $string,
  int $chunk_size = 1,
): vec<string>;
```




To split the string on a delimiter, see ` Str\split() `.




## Parameters




+ ` string $string `
+ ` int $chunk_size = 1 `




## Returns




* ` vec<string> `
<!-- HHAPIDOC -->
