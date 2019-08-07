``` yamlmeta
{
    "name": "HH\\Lib\\Str\\format",
    "sources": [
        "api-sources/hsl/src/str/format.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Given a valid format string (defined by ` SprintfFormatString `), return a
formatted string using `` $format_args ``




``` Hack
namespace HH\Lib\Str;

function format(
  SprintfFormatString $format_string,
  \mixed ...$format_args,
): string;
```




## Parameters




+ ` SprintfFormatString $format_string `
+ ` \mixed ...$format_args `




## Returns




* ` string `
<!-- HHAPIDOC -->
