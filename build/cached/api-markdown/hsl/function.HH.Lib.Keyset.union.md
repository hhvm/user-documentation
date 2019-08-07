``` yamlmeta
{
    "name": "HH\\Lib\\Keyset\\union",
    "sources": [
        "api-sources/hsl/src/keyset/combine.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new keyset containing all of the elements of the given
Traversables




``` Hack
namespace HH\Lib\Keyset;

function union<\Tv as arraykey>(
  \  Traversable<\Tv> $first,
  \  Container<\Tv> ...$rest,
): keyset<\Tv>;
```




For a variable number of Traversables, see ` Keyset\flatten() `.




Time complexity: O(n + m), where n is the size of ` $first ` and m is the
combined size of all the `` ...$rest ``
Space complexity: O(n + m), where n is the size of ``` $first ``` and m is the
combined size of all the ```` ...$rest ````




## Parameters




+ ` \ Traversable<\Tv> $first `
+ ` \ Container<\Tv> ...$rest `




## Returns




* ` keyset<\Tv> `
<!-- HHAPIDOC -->
