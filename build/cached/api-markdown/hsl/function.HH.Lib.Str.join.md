``` yamlmeta
{
    "name": "HH\\Lib\\Str\\join",
    "sources": [
        "api-sources/hsl/src/str/combine.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a string formed by joining the elements of the Traversable with the
given ` $glue ` string




``` Hack
namespace HH\Lib\Str;

function join(
  \  Traversable<\arraykey> $pieces,
  string $glue,
): string;
```




Previously known as ` implode ` in PHP.




## Parameters




+ ` \ Traversable<\arraykey> $pieces `
+ ` string $glue `




## Returns




* ` string `
<!-- HHAPIDOC -->
