``` yamlmeta
{
    "name": "HH\\Lib\\Regex\\split",
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




Splits ` $haystack ` into chunks by its substrings that match with `` $pattern ``




``` Hack
namespace HH\Lib\Regex;

function split<\T as HH\Lib\Regex\Match>(
  string $haystack,
  \  Pattern<\T> $delimiter,
  ?int $limit = NULL,
): vec<string>;
```




If ` $limit ` is given, the returned vec will have at most that many elements.
The last element of the vec will be whatever is left of the haystack string
after the appropriate number of splits.
If no substrings of `` $haystack `` match ``` $delimiter ```, a vec containing only ```` $haystack ```` will be returned.




Throws Invariant[Violation]Exception if ` $limit ` < 2.




## Parameters




+ ` string $haystack `
+ ` \ Pattern<\T> $delimiter `
+ ` ?int $limit = NULL `




## Returns




* ` vec<string> `
<!-- HHAPIDOC -->
