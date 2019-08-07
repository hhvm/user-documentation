``` yamlmeta
{
    "name": "HH\\Lib\\Regex\\first_match",
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




Returns the first match found in ` $haystack ` given the regex pattern `` $pattern ``
and an optional offset at which to start the search




``` Hack
namespace HH\Lib\Regex;

function first_match<\T as HH\Lib\Regex\Match>(
  string $haystack,
  \  Pattern<\T> $pattern,
  int $offset = 0,
): ?\T;
```




Throws Invariant[Violation]Exception if ` $offset ` is not within plus/minus the length of `` $haystack ``.
Returns null if there is no match, or a Match containing

+ the entire matching string, at key 0,
+ the results of unnamed capture groups, at integer keys corresponding to
  the groups' occurrence within the pattern, and
+ the results of named capture groups, at string keys matching their respective names.




## Parameters




* ` string $haystack `
* ` \ Pattern<\T> $pattern `
* ` int $offset = 0 `




## Returns




- ` ?\T `
<!-- HHAPIDOC -->
