``` yamlmeta
{
    "name": "HH\\Lib\\Vec\\concat",
    "sources": [
        "api-sources/hsl/src/vec/combine.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new vec formed by concatenating the given Traversables together




``` Hack
namespace HH\Lib\Vec;

function concat<\Tv>(
  \  Traversable<\Tv> $first,
  \  Container<\Tv> ...$rest,
): vec<\Tv>;
```




For a variable number of Traversables, see ` Vec\flatten() `.




Time complexity: O(n + m), where n is the size of ` $first ` and m is the
combined size of all the `` ...$rest ``
Space complexity: O(n + m), where n is the size of ``` $first ``` and m is the
combined size of all the ```` ...$rest ````




## Parameters




+ ` \ Traversable<\Tv> $first `
+ ` \ Container<\Tv> ...$rest `




## Returns




* ` vec<\Tv> `
<!-- HHAPIDOC -->
