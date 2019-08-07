``` yamlmeta
{
    "name": "HH\\Lib\\Regex\\replace_with",
    "sources": [
        "api-sources/hsl/src/regex/regex.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns ` $haystack ` with any substring matching `` $pattern ``
replaced by the result of ``` $replace_func ``` applied to that match




``` Hack
namespace HH\Lib\Regex;

function replace_with<\T as HH\Lib\Regex\Match>(
  string $haystack,
  \  Pattern<\T> $pattern,
  \callable $replace_func,
  int $offset = 0,
): string;
```




If ` $offset ` is given, replacements are made only starting from `` $offset ``.




Throws Invariant[Violation]Exception if ` $offset ` is not within plus/minus the length of `` $haystack ``.




## Parameters




+ ` string $haystack `
+ ` \ Pattern<\T> $pattern `
+ ` \callable $replace_func `
+ ` int $offset = 0 `




## Returns




* ` string `
<!-- HHAPIDOC -->
