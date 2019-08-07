``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\merge",
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




Merges multiple KeyedTraversables into a new dict




``` Hack
namespace HH\Lib\Dict;

function merge<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $first,
  \  KeyedContainer<\Tk, \Tv> ...$rest,
): dict<\Tk, \Tv>;
```




In the case of duplicate
keys, later values will overwrite the previous ones.




Time complexity: O(n + m), where n is the size of ` $first ` and m is the
combined size of all the `` ...$rest ``
Space complexity: O(n + m), where n is the size of ``` $first ``` and m is the
combined size of all the ```` ...$rest ````




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $first `
+ ` \ KeyedContainer<\Tk, \Tv> ...$rest `




## Returns




* ` dict<\Tk, \Tv> `
<!-- HHAPIDOC -->
