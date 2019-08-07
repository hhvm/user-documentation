``` yamlmeta
{
    "name": "HH\\Lib\\Regex\\every_match",
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




Returns all matches found in ` $haystack ` given the regex pattern `` $pattern ``
and an optional offset at which to start the search




``` Hack
namespace HH\Lib\Regex;

function every_match<\T as HH\Lib\Regex\Match>(
  string $haystack,
  \  Pattern<\T> $pattern,
  int $offset = 0,
): vec<\T>;
```




Throws Invariant[Violation]Exception if ` $offset ` is not within plus/minus the length of `` $haystack ``.




## Parameters




+ ` string $haystack `
+ ` \ Pattern<\T> $pattern `
+ ` int $offset = 0 `




## Returns




* ` vec<\T> `
<!-- HHAPIDOC -->
