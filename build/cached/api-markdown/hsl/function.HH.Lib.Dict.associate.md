``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\associate",
    "sources": [
        "api-sources/hsl/src/dict/combine.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict where each element in ` $keys ` maps to the
corresponding element in `` $values ``




``` Hack
namespace HH\Lib\Dict;

function associate<\Tk as arraykey, \Tv>(
  \  Traversable<\Tk> $keys,
  \  Traversable<\Tv> $values,
): dict<\Tk, \Tv>;
```




Time complexity: O(n) where n is the size of ` $keys ` (which must be the same
as the size of `` $values ``)
Space complexity: O(n) where n is the size of ``` $keys ``` (which must be the same
as the size of ```` $values ````)




## Parameters




+ ` \ Traversable<\Tk> $keys `
+ ` \ Traversable<\Tv> $values `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
