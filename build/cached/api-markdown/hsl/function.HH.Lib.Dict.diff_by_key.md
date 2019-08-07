``` yamlmeta
{
    "name": "HH\\Lib\\Dict\\diff_by_key",
    "sources": [
        "api-sources/hsl/src/dict/select.php"
    ],
    "lib": {
        "name": "the Hack Standard Library",
        "github": "hhvm/hsl",
        "composer": "hhvm/hsl"
    }
}
```




Returns a new dict containing only the entries of the first KeyedTraversable
whose keys do not appear in any of the other ones




``` Hack
namespace HH\Lib\Dict;

function diff_by_key<\Tk1 as arraykey, \Tk2 as arraykey, \Tv>(
  \  KeyedTraversable<\Tk1, \Tv> $first,
  \  KeyedTraversable<\Tk2, \mixed> $second,
  \  KeyedContainer<\Tk2, \mixed> ...$rest,
): dict<\Tk1, \Tv>;
```




Time complexity: O(n + m), where n is size of ` $first ` and m is the combined
size of `` $second `` plus all the ``` ...$rest ```
Space complexity: O(n + m), where n is size of ```` $first ```` and m is the combined
size of ````` $second ````` plus all the `````` ...$rest `````` -- note that this is bigger than
O(n)




## Parameters




+ ` \ KeyedTraversable<\Tk1, \Tv> $first `
+ ` \ KeyedTraversable<\Tk2, \mixed> $second `
+ ` \ KeyedContainer<\Tk2, \mixed> ...$rest `




## Returns




* ` dict<\Tk1, \Tv> `
<!-- HHAPIDOC -->
