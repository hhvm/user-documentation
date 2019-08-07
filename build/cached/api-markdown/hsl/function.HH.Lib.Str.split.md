``` yamlmeta
{
    "name": "HH\\Lib\\Str\\split",
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




Returns a vec containing the string split on the given delimiter




``` Hack
namespace HH\Lib\Str;

function split(
  string $string,
  string $delimiter,
  ?int $limit = NULL,
): vec<string>;
```




The vec
will not contain the delimiter itself.




If the limit is provided, the vec will only contain that many elements, where
the last element is the remainder of the string.




To split the string into equally-sized chunks, see ` Str\chunk() `.




Previously known as ` explode ` in PHP.




## Parameters




+ ` string $string `
+ ` string $delimiter `
+ ` ?int $limit = NULL `




## Returns




* ` vec<string> `
<!-- HHAPIDOC -->
